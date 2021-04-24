<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login',"loginController@login");
Route::get('dologin',"loginController@doLogin");
Route::get('signup',"signupController@signup");
Route::get('getBuilding',"signupController@getBuilding");
Route::get('getApartment',"signupController@getApartment");
Route::get('getService',"signupController@getService");
Route::get('getEmail',"signupController@getEmail");
Route::get('sendCode',"signupController@sendCode");
Route::get('register',"signupController@register");
Route::get('contact_us',"contactUsController@contactUs");
