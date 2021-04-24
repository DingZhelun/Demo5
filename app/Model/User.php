<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table = 'Contacts';
    public $primaryKey = 'contact_email';
    public $guarded = [];
    public $timestamps = false;

}
