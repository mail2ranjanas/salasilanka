<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Post;
use App\Item;
use App\RequestOrders;
use App\Material;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome To Salasi Lanka';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Us';
        //$role = Role::create(['name' => 'SiteManager']);
       // $permission = Permission::create(['name' => 'create-item-request']);
       //$role = Role::findById(1);
       //$permission = Permission::findById(2);
      // $role->givePermissionTo($permission);
      #$user=User::find(1);
      #$user->assignRole('Administrator');
       # return view('pages.about')->with('title', $title);

       $sites = array("Colombo-111", "Colombo-222", "Colombo-322", "Colombo-4", "Colombo-5");

       //$items = Material::all();
       //$items = $items->pluck('MATERIAL_DESCRIPTION', 'id');
      //$materialsList = DB::table('materials')->get();
     $materialsList = Material::all();
      foreach($materialsList as $mitem){
          //echo($item->MATERIAL_DESCRIPTION);
          // echo($item->MaterialUnit->unit);
           $mitem->MATERIAL_DESCRIPTION = $mitem->MATERIAL_DESCRIPTION."---".
           $unit=$mitem->materialUnit->unit;
          // $mitem->materialUnit->unit."---".$mitem->materialType->type;
          // echo($mitem->id."--");
      }
       $materialsList = $materialsList->pluck('MATERIAL_DESCRIPTION', 'id');
       $requestedItems = array();
       //$itemsArr = $items->plunk('id', 'itemCode');
       return view('posts.create')->with('materialsList', $materialsList)->with('sites', $sites)->with('requestedItems', $requestedItems);

    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
