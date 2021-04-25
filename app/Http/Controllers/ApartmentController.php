<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApartmentController extends Controller
{
	public function apartment(){
		return view('apartment');
	}
	
	public function sendPage(){
		return view('sendPage');
	}
	
	public function apart_report(){
		return view('apart_report');
	}
	

	
	
	public function getUser() {
        $user='';
        if(session('user')!=null)
        {
            $user = session('user_email');
            return json_encode($user);
        }
        return redirect('login');
    }
	public function apart_getContact(){
		$user_email = session('user_email');
		$sql="SELECT subdivision_name, subdivision_add, s.contact_email AS s_contact_email, building_number, building_add, ifnull(b.contact_email,'null') AS b_contact_email 
		FROM (Apartments a INNER JOIN Buildings b ON a.building_id=b.building_id) INNER JOIN Subdivisions s on b.subdivision_id = s.subdivision_id 
		WHERE a.contact_email='$user_email';";
		$result = DB::select($sql);
		$res="";
		foreach($result as $rows){
		$res = $res."<div class='building_board'>
		<p>Responsible Contacts</p>
		<table class='apartment_board'>
		<tr>
		<th>subdivision name</th>
		<th>subdivision address</th>
		<th>contact email</th>
		<th>chat</th>
		</tr>
		<tr>
			<td>".$rows->{'subdivision_name'}."</td>
			<td>".$rows->{'subdivision_add'}."</td>
			<td>".$rows->{'s_contact_email'}."</td>
			<td><a href='apart_message' onclick=\"setTo('".$rows->{'s_contact_email'}."')\">Click here</a></td>
			</tr>
		</table>
		<table class='apartment_board'>
			<tr>
			<th>building number</th>
			<th>building address</th>
			<th>contact email</th>
			<th>chat</th>
			</tr>
			<tr>
			<td>".$rows->{'building_number'}."</td>
			<td>".$rows->{'building_add'}."</td>
			<td>".$rows->{'b_contact_email'}."</td>
			<td><a href='apart_message' onclick=\"setTo('".$rows->{'b_contact_email'}."')\">Click here</a></td>
			</tr>
		</table>
		</div>";
		}
		
		$sql="SELECT ele_count, gas_count, water_count, int_count FROM Apartments WHERE contact_email='$user_email';";
		$apa_result = DB::select($sql);
		foreach($apa_result as $apa_rows){
		$res = $res."<div class='building_board'>
		<p>Service Usage</p>
		<table class='apartment_board'>
		<tr>
		<th>electricity</th>
		<th>gas</th>
		<th>water</th>
		<th>Internet</th>
		</tr>
		<tr>
			<td>".$apa_rows->{'ele_count'}."</td>
			<td>".$apa_rows->{'gas_count'}."</td>
			<td>".$apa_rows->{'water_count'}."</td>
			<td>".$apa_rows->{'int_count'}."</td>
			</tr>";
		$res = $res."</table></div>";	
		}
		return $res;
		}

	
	public function apart_sendRequest(Request $request) {
		$user_email = session('user_email');
		$input = $request->except("_token");
		$msg = $input['msg'];
		$sql = "INSERT INTO Requests (request_content,contact_email) VALUES ('$msg','$user_email');";
		DB::insert($sql);
    }
	
	 public function setTo(Request $request) {
        $input = $request->except("_token");
        session()->put('to',$input['to']);
        return $input;
    }
	
	public function apart_getReport(){
	$user_email = session('user_email');
	$sql = "SELECT * FROM Reports WHERE contact_email='$user_email';";
	$result = DB::select($sql);
	$res="<div class='building_board'>
	<table class='apartment_board'>
	<tr>
	<th>report time</th>
	<th>electricity</th>
	<th>gas</th>
	<th>water</th>
	<th>Internet</th>
	</tr>";
	foreach($result as $rows){
		$res=$res."<tr>
		<td>".$rows->{'report_time'}."</td>
		<td>".$rows->{'electricity'}."</td>
		<td>".$rows->{'gas'}."</td>
		<td>".$rows->{'water'}."</td>
		<td>".$rows->{'internet'}."</td>
		</tr>";
	}
	$res=$res."</table></div>";
	return $res;
	}
	
	public function apart_message(){
		return view('apart_message');
	}
	
	
	
	

		
}

	

