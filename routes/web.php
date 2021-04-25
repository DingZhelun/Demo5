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
<<<<<<< HEAD
Route::get('getUser',"subdivisionController@getUser");
Route::get('setTo',"subdivisionController@setTo");
Route::get('logout',"subdivisionController@logout");
Route::get('getMessage',"subdivisionController@getMessage");
Route::get('sendPage',"subdivisionController@sendPage");
Route::get('sendMessage',"subdivisionController@sendMessage");
Route::get('getTo',"subdivisionController@getTo");

/*
subdivision
*/
Route::get('subdivision',"subdivisionController@subdivision");
Route::get('subd_getBuilding',"subdivisionController@getBuilding");
Route::get('subd_getGraph',"subdivisionController@getGraph");
Route::get('subd_report',"subdivisionController@subd_report");
Route::get('subd_getReport',"subdivisionController@subd_getReport");
Route::get('subd_message',"subdivisionController@subd_message");


/*
building
*/
Route::get('building',"buildingController@building");
Route::get('build_getContact',"buildingController@getContact");
Route::get('build_getGraph',"buildingController@getGraph");
Route::get('build_report',"buildingController@build_report");
Route::get('build_getReport',"buildingController@build_getReport");
Route::get('build_message',"buildingController@build_message");
=======
Route::get('contact_us',"contactUsController@contactUs");
>>>>>>> f477ef99c1f7943a1cc1244239fcd46989ad3fb9
