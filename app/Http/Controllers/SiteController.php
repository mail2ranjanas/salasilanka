<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Site;
use App\SiteUser;
use App\User;
use DB;
use Illuminate\Support\Facades\Log as FacadesLog;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sites = Site::all();
        return view('site.show')->with('sites', $sites);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.sitecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $site = new Site;
        $site->Site_Name = $request->input('site');
        $site->Site_Desc = $request->input('siteDesc');
        $site->save();
        $sites = Site::all();
        return view('site.show')->with('sites', $sites);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Site::find($id);
        $users = User::all();
        $users_list = array();
        foreach($site->users as $user){
           $users_list[] = $user->id;
        }
        Log::info($users_list);
        return view('site.edit')->with('site', $site)
                                ->with('users_list', $users_list)
                                ->with('users', $users);
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
        
        
        $users_list = array();
        Log::info($request->input('usersList'));
        Log::info($id);
        
        DB::table('site_user')->where('site_id', '=', $id)->delete();
        foreach($request->input('usersList') as $user){
            Log::info('insert');
            DB::insert('insert into site_user (site_id, user_id) values (?, ?)', [$id, $user]);
        }
        $users = User::all();
        $site = Site::find($id);
        foreach($site->users as $user){
            $users_list[] = $user->id;
        }

        // return view('site.edit')->with('site', $site)
        // ->with('users_list', $users_list)
        // ->with('users', $users);
        $sites = Site::all();
        return view('site.show')->with('sites', $sites);;
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
