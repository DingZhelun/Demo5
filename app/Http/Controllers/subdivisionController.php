<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class subdivisionController extends Controller
{
    //
    public function subdivision() {
        return view('subdivision');
    }

    public function subd_report() {
        return view('subd_report');
    }

    public function subd_message() {
        return view('subd_message');
    }

    public function sendPage() {
        return view('sendPage');
    }

    public function messageTest() {
        return view('messageTest');
    }


    public function getUser() {

        $user = session('user_email');
        return json_encode($user);

    }

    public function getBuilding() {
        $user_email = session('user_email');
        $sql = "select building_id, building_number, building_add, IFNULL(b.contact_email,'null') as 'contact_email', contact_name, contact_tel
                from (Subdivisions s INNER JOIN Buildings b on s.subdivision_id=b.subdivision_id)
                LEFT OUTER JOIN Contacts c on b.contact_email=c.contact_email
                WHERE s.contact_email = '$user_email'
                order by building_number;";
        $result = DB::select($sql);
        $res="";
        foreach($result as $rows){
        if($rows->{'contact_email'}=="null"){
            $res = $res."<div class='building_board'><div>
        <p class='type_info'>building number:</p> <p class='info'>".$rows->{'building_number'}."</p>
        <p class='type_info'>address:</p><p class='info'>".$rows->{'building_add'}."</p>
        <p class='type_info'>responsible contact:</p><p class='info'>null</p>
        <p class='type_info'>tel:</p><p class='info'>null</p>
        <p class='type_info'>chat:</p><p class='info'>null</p></div>
        <p class='apartment_text'> apartments </p>
                <table class='apartment_board'>
                    <tr>
                    <th>apartment_number<//th>
                    <th>contact</th>
                    <th>tel</th>
                    <th>electricity</th>
                    <th>water</th>
                    <th>gas</th>
                    <th>chat</th>
                    </tr>";
        }
        else{
            $res = $res."<div class='building_board'><div>
        <p class='type_info'>building number:</p> <p class='info'>".$rows->{'building_number'}."</p>
        <p class='type_info'>address:</p><p class='info'>".$rows->{'building_add'}."</p>
        <p class='type_info'>responsible contact:</p><p class='info'>".$rows->{'contact_email'}."</p>
        <p class='type_info'>tel:</p><p class='info'>".$rows->{'contact_tel'}."</p>
        <p class='type_info'>chat:</p><p class='info'><a href='sendPage' onclick=\"setTo('".$rows->{'contact_email'}."')\">click here</a></p></div>
        <p class='apartment_text'> apartments </p>
                <table class='apartment_board'>
                    <tr>
                    <th>apartment_number</th>
                    <th>contact</th>
                    <th>tel</th>
                    <th>electricity</th>
                    <th>water</th>
                    <th>gas</th>
                    <th>chat</th>
                    </tr>";
        }
        
        $building = $rows->{'building_id'};
        $sql = "SELECT apartment_number, ifnull(c.contact_email,'null') as 'contact_email', contact_name,contact_tel , ele_count, water_count, gas_count, int_count FROM Apartments a LEFT OUTER JOIN Contacts c on a.contact_email = c.contact_email WHERE building_id='$building';";
        $sub_result = DB::select($sql);
        foreach($sub_result as $sub_rows){
            $c_email=$sub_rows->{'contact_email'};
            if($c_email=="null"){
            $res = $res."<tr>
            <td>".$sub_rows->{'apartment_number'}."</td>
            <td>null</td>
            <td>null</td>
            <td>".$sub_rows->{'ele_count'}."</td>
            <td>".$sub_rows->{'water_count'}."</td>
            <td>".$sub_rows->{'gas_count'}."</td>
            <td>null</td>
            </tr>";
            }
            else{
            $res = $res."<tr>
            <td>".$sub_rows->{'apartment_number'}."</td>
            <td>".$sub_rows->{'contact_email'}."</td>
            <td>".$sub_rows->{'contact_tel'}."</td>
            <td>".$sub_rows->{'ele_count'}."</td>
            <td>".$sub_rows->{'water_count'}."</td>
            <td>".$sub_rows->{'gas_count'}."</td>
            <td><a href='sendPage' onclick=\"setTo('".$c_email."')\">Click here</a></td>
            </tr>";
            }
        }
        $res = $res."</table></div>";
        }
        return $res;
    }

    public function setTo(Request $request) {
        $input = $request->except("_token");
        session()->put('to',$input['to']);
        return $input;
    }

    public function getGraph() {
        $user_email = session('user_email');
        $sql = "select building_number, ele_count, gas_count, water_count
        from Subdivisions s INNER JOIN Buildings b on s.subdivision_id=b.subdivision_id
        where s.contact_email='$user_email';";
        $result = DB::select($sql);
        $building;
        $ele;
        $gas;
        $water;
        foreach($result as $rows){
            $building[]=$rows->{'building_number'};
            $ele[] = $rows->{'ele_count'};
            $gas[] = $rows->{'gas_count'};
            $water[] = $rows->{'water_count'};
        }
        $res = array($building,$ele,$gas,$water);
        return json_encode($res);
    }

    public function logout() {
        if(session('user_email')!=null){
            session()->forget('user_email');
        }
    }

    public function subd_getReport() {
        $user_email = session('user_email');
        $sql = "SELECT r.contact_email,r.report_time , a.apartment_id, a.building_id ,r.electricity, r.water, r.gas, r.internet FROM 
        ((Reports r INNER JOIN Apartments a on r.contact_email=a.contact_email) 
        INNER JOIN Buildings b on a.building_id=b.building_id) INNER JOIN Subdivisions s on b.subdivision_id=s.subdivision_id
        WHERE s.contact_email='$user_email'; ";
        $result = DB::select($sql);
        $res="<div class='building_board'>
        <table class='apartment_board'>
        <tr>
        <th>building</th>
        <th>apartment</th>
        <th>contact email</th>
        <th>report time</th>
        <th>electricity</th>
        <th>gas</th>
        <th>water</th>
        <th>Internet</th>
        </tr>";
        foreach($result as $rows){
            $res=$res."<tr>
            <td>".$rows->{'building_id'}."</td>
            <td>".$rows->{'apartment_id'}."</td>
            <td>".$rows->{'contact_email'}."</td>
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

    public function getMessage() {
        $user_email = session('user_email');
        $sql="select * from Chats where to_contact_email='$user_email';";
        $result = DB::select($sql);
        $res="<div class='building_board'>
        <p>INBOX</p>
        <table class='apartment_board'>
        <tr>
        <th>From</th>
        <th>time</th>
        <th>content</th>
        </tr>";
        foreach($result as $rows){
            $res=$res."<tr>
            <td>".$rows->{'from_contact_email'}."</td>
            <td>".$rows->{'time'}."</td>
            <td>".$rows->{'chat_content'}."</td>
            </tr>";
        }
        $sql="select * from Chats where from_contact_email='$user_email';";
        $result = DB::select($sql);
        $res = $res."</table></div>
        <div class='building_board'>
        <p>OUTBOX</p>
        <table class='apartment_board'>
        <tr>
        <th>To</th>
        <th>time</th>
        <th>content</th>
        </tr>";
        foreach($result as $rows){
            $res=$res."<tr>
            <td>".$rows->{'to_contact_email'}."</td>
            <td>".$rows->{'time'}."</td>
            <td>".$rows->{'chat_content'}."</td>
            </tr>";
        }
        $res = $res."</table></div>";
        return $res;
    }

    public function sendMessage(Request $request) {
        $user_email = session('user_email');
        $input = $request->except("_token");
        $to=$input['to'];
        $msg=$input['msg'];
        // $to="38@qq.com";
        // $msg="function test";
        
        $sql="INSERT INTO `zxc9069_youareondefault`.`Chats` (`from_contact_email`,`to_contact_email`,`chat_content`) VALUES('$user_email','$to','$msg');";
        DB::insert($sql);
    }

    public function getTo() {
        $to = session('to');
        return json_encode($to);
    }
}
