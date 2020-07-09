<?php

namespace App\Http\Controllers;

use App\RequestOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.reports');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        Log::info('ReportsController show- '.$id);
    }

    public function weekly()
    {
        //
        Log::info('ReportsController weekly- ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        Log::info('ReportsController '.$id);
        $reportContents = null;
        if(strcmp($id, 'one')==0){
            Log::info('weekly report generate');
            $reportContents = RequestOrders::where('created_at' ,'>=', Carbon::now()->subDays(5))->get();
            Log::info($reportContents);
        }
        if(strcmp($id, 'two')==0){
            Log::info('two report generate');
        }
        if(strcmp($id, 'all')==0){
            Log::info('whole report generate');
        }
        return view('reports.show')->with('reportContents', $reportContents);
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
        //
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
