<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestOrders extends Model
{
    //

    protected $table = 'request_orders';
    public $primaryKey = 'id';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'Requested_User_ID');
    }
    public function material()
    {
        return $this->hasOne('App\Material', 'id', 'Material_ID');
    }
    public function unit()
    {
        return $this->hasOne('App\MaterialUnit', 'id', 'Material_Unit');
    }
    public function site()
    {
        return $this->hasOne('App\Site', 'id', 'Site_ID');
    }
}
