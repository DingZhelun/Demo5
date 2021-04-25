<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function admin() {
     return view('admin');
    }
	public function superuser_modify() {
     return view('superuser_modify');
    }
	public function admin_message() {
     return view('admin_message');
    }
	
	public function super_getInfo() {
		$user_email = session('user_email');
		$sql = "select * from Contacts";
		$result = DB::select($sql);
		$res="<div class='building_board'>
		<table class='apartment_board'>
		<tr>
		<th>email</th>
		<th>name</th>
		<th>tel</th>
		<th>password</th>
		<th>role</th>
		<th>option</th>
		</tr>";
		foreach($result as $rows){
			$email= $rows->{'contact_email'};
			$res=$res."<tr>
			<td>".$rows->{'contact_email'}."</td>
			<td>".$rows->{'contact_name'}."</td>
			<td>".$rows->{'contact_tel'}."</td>
			<td>".$rows->{'password'}."</td>
			<td>".$rows->{'role'}."</td>
			<td>
			<a href='superuser_modify' onclick=\"modifyUser('".$email."')\">modify</a>
			<a href='#' onclick=\"deleteUser('".$email."')\">delete</a>
			</td>
			</tr>";
		}
		$res=$res."</table></div>";
		return $res;
			}
		
	public function super_deleteUser() {
		$user_email = session('user_email');
		$user = $_GET['user'];
		$sql="delete from Contacts where contact_email='$user';";
		DB::select($sql);
    }
	
	public function super_setModify() {
		$user = $_GET['user'];
		session()->put('modify',$user);
		return $user;
    }

	public function super_defaultInfo() {
	$user = session('modify');
	$sql = "select * from Contacts where contact_email='$user';";
	$result=DB::select($sql);
	$res;
	foreach($result as $rows){
		$res = $rows;
	}
	return json_encode($res);
    }
	
	public function sendMessage(Request $request) {
		$user_email = session('user_email');
		$input = $request->except("_token");
		$to=$input['to'];
		$msg=$input['msg'];		
		$sql="INSERT INTO `zxc9069_youareondefault`.`Chats` (`from_contact_email`,`to_contact_email`,`chat_content`) VALUES('$user_email','$to','$msg');";
		DB::insert($sql);
	}
	
	public function super_updateUser() {
		$email=$_GET['email'];
		$name=$_GET['name'];
		$tel=$_GET['tel'];
		$password=$_GET['password'];
		$role=$_GET['role'];
		$sql = "UPDATE Contacts SET contact_name='$name', contact_tel='$tel', password='$password', role='$role' WHERE contact_email='$email';";
		DB::UPDATE($sql);
	}
	
}

	

