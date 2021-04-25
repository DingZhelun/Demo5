<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //
    public $table = 'Reports';
    public $primaryKey = 'report_id';
    public $guarded = [];
    public $timestamps = false;
}