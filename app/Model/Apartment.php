<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    public $table = 'Apartments';
    public $primaryKey = 'apartment_id';
    public $guarded = [];
    public $timestamps = false;
}
