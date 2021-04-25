<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Controllers\Controller;

class WhyusController extends Controller
{
    //whyus页面
	public function whyus(){
		return view('whyus');
	}
}
