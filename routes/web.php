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
Route::get('homepage','HomepageController@homepage');
Route::get('whyus','Whyuscontroller@whyus');
Route::get('login',"loginController@login");
Route::post('dologin',"loginController@doLogin");
Route::get('signup',"signupController@signup");
Route::get('getBuilding',"signupController@getBuilding");
Route::get('getApartment',"signupController@getApartment");
Route::get('getService',"signupController@getService");
Route::get('getEmail',"signupController@getEmail");
Route::get('sendCode',"signupController@sendCode");
Route::get('register',"signupController@register");
Route::get('getUser',"subdivisionController@getUser");
Route::get('setTo',"subdivisionController@setTo");
Route::get('logout',"subdivisionController@logout");
Route::get('getMessage',"subdivisionController@getMessage");
Route::get('sendPage',"subdivisionController@sendPage");
Route::get('sendMessage',"subdivisionController@sendMessage");
Route::get('getTo',"subdivisionController@getTo");
Route::get('contact_us',"contactUsController@contactUs");

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

Route::get('contact_us',"contactUsController@contactUs");
/*
admin
*/
Route::get('admin',"AdminController@admin");
Route::get('super_getInfo',"AdminController@super_getInfo");
Route::get('super_deleteUser',"AdminController@super_deleteUser");
Route::get('super_defaultInfo',"AdminController@super_defaultInfo");
Route::get('super_setModify',"AdminController@super_setModify");
Route::get('superuser_modify',"AdminController@superuser_modify");
Route::get('admin_message',"AdminController@admin_message");
Route::get('super_updateUser',"AdminController@super_updateUser");

/*
apartment
*/
Route::get('apartment',"ApartmentController@apartment");
Route::get('apart_getContact',"ApartmentController@apart_getContact");
Route::get('apart_sendRequest',"ApartmentController@apart_sendRequest");
Route::get('apart_report',"ApartmentController@apart_report");
Route::get('apart_getReport',"ApartmentController@apart_getReport");
Route::get('apart_message',"ApartmentController@apart_message");

