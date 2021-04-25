<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    //
    public $table = 'Requests';
    public $primaryKey = 'request_id';
    public $guarded = [];
    public $timestamps = false;
}