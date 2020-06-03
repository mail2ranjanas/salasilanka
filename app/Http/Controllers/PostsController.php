<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Item;
use App\RequestOrders;
use App\Material;
use DB;
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
        session_start();
        
        $sites = array("Colombo-1", "Colombo-2", "Colombo-3", "Colombo-4", "Colombo-5");

        $items = Material::all();
       $materialsList = Material::all();
        foreach($materialsList as $mitem){
            $mitem->MATERIAL_DESCRIPTION = $mitem->MATERIAL_DESCRIPTION."---".
            $mitem->materialUnit->unit."---".$mitem->materialType->type;
        }
       // $materialsList = $materialsList->pluck('MATERIAL_DESCRIPTION', 'id');
        $requestedItems = array();
        $_SESSION["materialsList"] = $materialsList;

        return view('posts.create')->with('materialsList', $materialsList)->with('sites', $sites)->with('requestedItems', $requestedItems);
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
       $requestOrder->save();

       //Create Item Request
       //$itemRequest = new ItemRequest;
       $sites = array("Colombo-1", "Colombo-2", "Colombo-3", "Colombo-4", "Colombo-5");
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

        $requestOrder = RequestOrders::find($id);
        
        //Check if post exists before deleting
        if (!isset($requestOrder)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        return view('posts.edit')->with('requestOrder', $requestOrder);
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
        $requestOrder = RequestOrders::find($id);
        
        // Update Post
        $requestOrder->status = $request->input('status');
        $requestOrder->save();

        return redirect('/posts')->with('success', 'Post Updated');
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
