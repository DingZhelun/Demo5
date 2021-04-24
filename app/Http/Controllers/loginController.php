<?php

namespace App\Http\Controllers;

use App\Model\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function doLogin(Request $request){
        $input = $request->except("_token");
//        $input['email'] = "8@qq.com";
//        $input['password'] = "123456";
        $email = $input['email'];

        if ($input['email']==""||$input['password']==""){
            return redirect('login')->withErrors("Email and password cannot be empty");
        }

        $user = User::where('contact_email',$input['email'])->first();
        if (!$user){
            return redirect('login')->withErrors("Email does not exist");
        }

        echo $user;

        if ($user['password']==$input['password']){
            if ($user['available']=="1"){
                session()->put('user_email',$input['email']);

                if ($user['role']=="Subdivision")
                    return redirect('subdivision');
                else if ($user['role']=="Building")
                    return redirect('building');
                else if ($user['role']=="Apartment")
                    return redirect('apartment');
                else if ($user['role']=="Admin")
                    return redirect('admin');
            }else{
                return redirect('login')->withErrors("The user is not activated, please go to the registration page to activate");
            }

        }else{
            return redirect('login')->withErrors("The entered password is incorrect");
        }
    }
}
