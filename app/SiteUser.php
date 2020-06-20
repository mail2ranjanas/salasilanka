<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SiteUser extends Model
{
    //
    protected $table = 'site_user';
  // public $primaryKey = ['user_id','site_id'];

  public function users()
  {
      return $this->belongsToMany(User::class, 'role_user');
  }
    
}
