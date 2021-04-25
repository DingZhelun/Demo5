<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class realchats extends Model
{
    //
    public $table = 'realchats';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}