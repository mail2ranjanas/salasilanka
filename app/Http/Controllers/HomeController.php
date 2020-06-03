<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Http\Request;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=User::find(20); 

        $role1=Role::find(1);
        $role2=Role::find(2);

        $user->assignRole($role1);
        $user->assignRole($role2);

        Log::info($user->getRoleNames());
        Log::info($user->name);
        return view('home');
    }
}
