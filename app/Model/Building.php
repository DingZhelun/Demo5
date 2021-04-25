<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    public $table = 'Buildings';
    public $primaryKey = 'building_id';
    public $guarded = [];
    public $timestamps = false;
}
