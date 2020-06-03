<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    // Table Name
    protected $table = 'material_type';
    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;


}