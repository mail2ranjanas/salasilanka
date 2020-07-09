<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Item;
use App\RequestOrders;
use App\Material;
use App\Site;
use DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materialsList = null;
        $requestedItems = array();
        $items = Material::all();
        $sites = null;

        //Load site list 
        if(auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){
            $sites = Site::all();
        }else{
            
            $sitesList = DB::table('site_user')->where('user_id', auth()->user()->id)->pluck('site_id');
            Log::info($sitesList);
            $sites = Site::whereIn('id', $sitesList)->get();
            Log::info($sites);
        }

        session_start();
        if(!isset($_SESSION["materialsList"])){
            Log::info('Session is empty, loading materials from the database');
            $materialsList = Material::all();
            foreach($materialsList as $mitem){
                $mitem->MATERIAL_DESCRIPTION = $mitem->MATERIAL_DESCRIPTION."---".
                $mitem->materialUnit->unit."---".$mitem->materialType->type;
            }
            $_SESSION["materialsList"] = $materialsList;
        }else{
            Log::info('Session is available, loading materials from Session');
            $materialsList = $_SESSION["materialsList"];
        }
        
        if(auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){ // Load orders from all sites
            $requestedItems = RequestOrders::where('Status', '!=', 'RECEIVED')->get();
        }
        else if(auth()->user()->hasRole('SK|Site')){ // Load orders belons to their site
            // $sites = auth()->user()->sites;
            
            // $siteList = "";
            // foreach ($sites as $site) {
            //     $siteList != "" && $siteList .= ",";
            //     $siteList .= $site->id;
            // }
            $siteList = DB::table('site_user')->where('user_id', auth()->user()->id)->pluck('site_id');
            Log::info($siteList);
            $requestedItems = RequestOrders::whereIn('Site_ID', $siteList)->orderBy('created_at','desc')->get();
        }else{
            
        }
        return view('posts.create')->with('materialsList', $materialsList)
        ->with('sites', $sites)
        ->with('requestedItems', $requestedItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();
        $this->validate($request, [
            'siteId' => 'required',
            'quantity' => 'required',
            'dispatchDate' => 'required'
        ]);
       $materialsList = $_SESSION["materialsList"];
      // Log::info('This is some useful information.');
       Log::info($request->input('siteId'));

       $requestOrder = new RequestOrders;
       $requestOrder->Site_Id = $request->input('siteId');
       $requestOrder->Material_ID = $request->input('materialId');
       $requestOrder->Requested_Date = date("Y/m/d");
       $requestOrder->Dispatch_Date = $request->input('dispatchDate');
       $requestOrder->Requested_User_ID = auth()->user()->id;
       $requestOrder->Status="NEW";
       $requestOrder->remarks = $request->input('remarks');
       $requestOrder->save();

       //Create Item Request
       //$itemRequest = new ItemRequest;
       $sites = null;
         //Load site list 
        if(auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){
            $sites = Site::all();
        }else{
            $sitesList = DB::table('site_user')->where('user_id', auth()->user()->id)->pluck('site_id');
            $sites = Site::whereIn('id', $sitesList)->get();
            Log::info($sites);
        }
       $materialsList = $_SESSION["materialsList"];
       
       $requestedItems = array();

       $items = Material::all();
       $items = $items->pluck('itemCode', 'id');

       $requestedItems = RequestOrders::where('Requested_User_ID',auth()->user()->id)->get();

       return view('posts.create')->with('materialsList', $materialsList)->with('sites', $sites)
                    ->with('requestedItems', $requestedItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$post = Post::find($id);
        Log::info('edit');
        $requestOrder = RequestOrders::find($id);
        $orderStatus = null;
        $selectedOrder = null;
        //Check if post exists before deleting
        if (!isset($requestOrder)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        if($requestOrder->status=="NEW"){
            $orderStatus = array(
                 "QQ",
                  "HOLD",
            );
            $selectedOrder="QQ";
        }

        return view('posts.edit')->with('requestOrder', $requestOrder)
                ->with('orderStatus', $orderStatus)
                ->with('selectedOrder',$selectedOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('update');
        $requestOrder = RequestOrders::find($id);
        
        // Update Post
        $requestOrder->status = $request->input('status');
        $requestOrder->remarks = $request->input('remarks');
        $requestOrder->save();

        return view('orders.updatesuccess')->with('requestOrder', $requestOrder);
        //return redirect('/posts')->with('success', 'Post Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        //Check if post exists before deleting
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
