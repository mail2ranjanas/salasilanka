<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestOrders;
use Log;
use DB;
use Illuminate\Support\Facades\Log as FacadesLog;

class RequestOrderController extends Controller
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
        if(!auth()->user())
        {
            return back()->with('status','Access Denied or your message');
        }
        //if(auth()->user()->hasRole('Administrator')){

       // }
       $requestedItems = array();
        if(auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){
            $requestedItems = RequestOrders::orderBy('created_at','desc')->paginate(8);
        }else{
            $siteList = DB::table('site_user')->where('user_id', auth()->user()->id)->pluck('site_id');
            // foreach(auth()->user()->sites as $site){
            //     $siteList != "" && $siteList .= ",";
            //     $siteList .= $site->id;
            // }
            Log::info($siteList);
            
            if(!empty($siteList)){
                //$siteArr1 = implode(",", $siteList);
                Log::info($siteList);
               // $siteList = 8,9;
                $requestedItems = RequestOrders::whereIn('Site_ID', $siteList)->orderBy('created_at','desc')->paginate(8);
            }
        }
        
        return view('orders.showorders')->with('requestedItems', $requestedItems);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('RequestOrders :show-------------------------'.$request->input('status'));
        $status = $request->input('status');

        if(strcmp($status,'All')==0 && auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){
            Log::info('All');
            $requestedItems = RequestOrders::all();
            Log::info($requestedItems);
            //return view('orders.showorders')->with('requestedItems', $requestedItems)->paginate(8);
            $requestedItems = RequestOrders::orderBy('created_at','desc')->paginate(8);
            return view('orders.showorders')->with('requestedItems', $requestedItems);
        }
        if(strcmp($status,'All')==0 && auth()->user()->hasRole('SK|SITE')){
            Log::info('All');
            $requestedItems = RequestOrders::all();
            Log::info($requestedItems);
            $requestedItems = RequestOrders::orderBy('created_at','desc')->paginate(8);
            return view('orders.showorders')->with('requestedItems', $requestedItems);
        }

        if(auth()->user()->hasRole('Administrator|Registar|Office|PO|QA')){
            $requestedItems = RequestOrders::where('Status',$status)->paginate(8);
        }else{
            $siteList = DB::table('site_user')->where('user_id', auth()->user()->id)->pluck('site_id');
            // foreach(auth()->user()->sites as $site){
            //     $siteList != "" && $siteList .= ",";
            //     $siteList .= $site->id;
            // }
            Log::info($siteList);
            
            if(!empty($siteList)){
                Log::info('site list'.$siteList);
                $requestedItems = RequestOrders::whereIn('Site_ID', $siteList)->where('Status',$status)->orderBy('created_at','desc')->paginate(8);
            }
        }
        
        return view('orders.showorders')->with('requestedItems', $requestedItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderStatus = null;
        $selectedOrder = null;

        $requestOrder = RequestOrders::find($id);
        if (!isset($requestOrder)){
            return redirect('/posts')->with('error', 'No Post Found');
        }
        if(strcmp($requestOrder->Status,"NEW")==0){
            Log::info('NEW');
            $orderStatus = array(
                'QQ' => 'QQ',
                'HOLD' => 'HOLD',
            );
            $selectedOrder="QQ";
        }
        if(strcmp($requestOrder->Status,"QQ")==0){
            Log::info('QQ');
            $orderStatus = array(
                'PO' => 'PO',
                'HOLD' => 'HOLD',
            );
            $selectedOrder="PO";
        }
        if(strcmp($requestOrder->Status,"PO")==0){
            Log::info('PO');
            $orderStatus = array(
                'DISPATCHED' => 'DISPATCHED',
                'HOLD' => 'HOLD',
            );
            $selectedOrder="DISPATCHED";
        }
        if(strcmp($requestOrder->Status,"DISPATCHED")==0){
            Log::info('DISPATCHED');
            $orderStatus = array(
                'RECEIVED' => 'RECEIVED',
                'HOLD' => 'HOLD',
            );
            $selectedOrder="RECEIVED";
        }
        if(strcmp($requestOrder->Status,"RECEIVED")==0){
            Log::info('RECEIVED');
            $orderStatus = array(
                'RECEIVED' => 'RECEIVED',
                'HOLD' => 'HOLD',
            );
            $selectedOrder="RECEIVED";
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
        $orderStatus = $request->input('status');

        Log::info('update'.$orderStatus);
        $requestOrder = RequestOrders::find($id);
        $requestOrder->status = $orderStatus;
        $requestOrder->remarks = $request->input('remarks');
        
        if(strcmp($orderStatus, 'QQ')==0){
            Log::info('Status '.$orderStatus);
            $requestOrder->Quality_Checked_Date=date("Y/m/d");
            $requestOrder->Quality_Checked=auth()->user()->id;
        }
        if(strcmp($orderStatus, 'PO')==0){
            Log::info('Status '.$orderStatus);
            $requestOrder->PO_Date=date("Y/m/d");
            $requestOrder->PO_By=auth()->user()->id;
        }
        if(strcmp($orderStatus, 'DISPATCHED')==0){
            Log::info('Status '.$orderStatus);
            $requestOrder->D_Date=date("Y/m/d");
            $requestOrder->Dispatched_By=auth()->user()->id;
        }
        if(strcmp($orderStatus, 'RECEIVED')==0){
            Log::info('Status '.$orderStatus);
            $requestOrder->Received_Date=date("Y/m/d");
            $requestOrder->Received_By=auth()->user()->id;
        }

        $requestOrder->save();

        return view('orders.updatesuccess')->with('requestOrder', $requestOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
