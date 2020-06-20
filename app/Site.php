<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Site extends Model
{
    //
    protected $table = 'sites';
    public $primaryKey = 'id';

    public function users()
    {
        return $this->belongsToMany(User::class, 'site_user');
    }
    
}
