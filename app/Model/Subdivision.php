<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    //
    public $table = 'Subdivisions';
    public $primaryKey = 'subdivision_id';
    public $guarded = [];
    public $timestamps = false;
}
