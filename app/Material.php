<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $table = 'materials';
    public $primaryKey = 'id';

    public $description='MATERIAL_DESCRIPTION';

    public function materialUnit()
    {
        return $this->hasOne('App\MaterialUnit', 'id', 'UNIT_ID');
    }
    public function materialType()
    {
        return $this->hasOne('App\MaterialType', 'id', 'MATERIAL_TYPE_ID');
    }
}
