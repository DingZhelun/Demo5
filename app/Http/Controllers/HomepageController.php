<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    //主页
	public function homepage(){
	return view('homepage');
	}
}
