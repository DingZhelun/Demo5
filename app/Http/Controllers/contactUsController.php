<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactUsController extends Controller
{
    //
    public function contactUs(){
        return view('contact_us');
    }
}
