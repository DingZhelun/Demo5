<?php

namespace App\Http\Controllers;

use App\Model\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class loginController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function doLogin(Request &$request){
        $input = $request->except("_token");

        if ($input['email']==""||$input['password']==""){
            return redirect('login')->withErrors("Email and password cannot be empty");
        }

        $user = User::where('contact_email',$input['email'])->first();
        if (!$user){
            return redirect('login')->withErrors("Email does not exist");
        }

        if ($user['password']==$input['password']){
            return redirect('admin');
        }else{
            return redirect('login')->withErrors("The entered password is incorrect");
        }
    }
}
