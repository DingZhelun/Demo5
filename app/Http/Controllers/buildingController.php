<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class buildingController extends Controller
{
    public function building() {
        return view('building');
    }

    public function build_report() {
        return view('build_report');
    }

    public function build_message() {
        return view('build_message');
    }


    public function getContact() {
        $user_email = session('user_email');
        $sql="select subdivision_name, subdivision_add, s.contact_email, building_id 
        from Buildings b inner join Subdivisions s 
        on b.subdivision_id=s.subdivision_id where b.contact_email='$user_email';";
        $result = DB::select($sql);
        $res="";
        $building;
        foreach($result as $rows){
            $building=$rows->{'building_id'};
            $res = $res."<div class='building_board'>
            <p>Subdivision Contacts</p>
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
                <td>".$rows->{'contact_email'}."</td>
                <td><a href='sendPage' onclick=\"setTo('".$rows->{'contact_email'}."')\">Click here</a></td>
                </tr>
            </table>
            </div>";
        }
        $sql = "SELECT apartment_number, ifnull(c.contact_email, 'null') as 'contact_email', contact_name,contact_tel , ele_count, water_count, gas_count, int_count FROM Apartments a LEFT OUTER JOIN Contacts c on a.contact_email = c.contact_email WHERE building_id='$building';";
        $sub_result = DB::select($sql);
        $res = $res."<div class='building_board'>
            <p>Apartments</p>
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
        return $res;
    }

    public function getGraph() {
        $user_email = session('user_email');
        $sql = "select apartment_number, a.ele_count, a.gas_count, a.water_count
        from Apartments a INNER JOIN Buildings b on a.building_id=b.building_id
        where b.contact_email='$user_email';";
        $result = DB::select($sql);
        $building;
        $ele;
        $gas;
        $water;
        foreach($result as $rows){
            $building[]=$rows->{'apartment_number'};
            $ele[] = $rows->{'ele_count'};
            $gas[] = $rows->{'gas_count'};
            $water[] = $rows->{'water_count'};
        }
        $res = array($building,$ele,$gas,$water);
        return json_encode($res);
    }

    public function build_getReport() {
        $user_email = session('user_email');
        $sql = "SELECT apartment_number, r.contact_email, report_time, r.water, r.gas, r.electricity, r.internet
                FROM (Reports r inner join Apartments a 
                on r.contact_email=a.contact_email) inner join Buildings b 
                on a.building_id=b.building_id 
                WHERE b.contact_email='$user_email'
                order by apartment_number;";
        $result = DB::select($sql);
        $res="<div class='building_board'>
        <p>Reports</p>
        <table class='apartment_board'>
        <tr>
        <th>apartment</th>
        <th>contact</th>
        <th>report time</th>
        <th>electricity</th>
        <th>gas</th>
        <th>water</th>
        <th>Internet</th>
        </tr>";
        foreach($result as $rows){
            $res=$res."<tr>
            <td>".$rows->{'apartment_number'}."</td>
            <td>".$rows->{'contact_email'}."</td>
            <td>".$rows->{'report_time'}."</td>
            <td>".$rows->{'electricity'}."</td>
            <td>".$rows->{'gas'}."</td>
            <td>".$rows->{'water'}."</td>
            <td>".$rows->{'internet'}."</td>
            </tr>";
        }
        $res=$res."</table></div>";

        $sql = "SELECT apartment_number, r.contact_email, request_time, request_content
        FROM (Requests r inner join Apartments a 
        on r.contact_email=a.contact_email) inner join Buildings b 
        on a.building_id=b.building_id WHERE b.contact_email='$user_email';";
        $result = DB::select($sql);
        $res=$res."<div class='building_board'>
        <p>Requests</p>
        <table class='apartment_board'>
        <tr>
        <th>apartment</th>
        <th>contact</th>
        <th>request time</th>
        <th>content</th>
        </tr>";
        foreach($result as $rows){
            $res=$res."<tr>
            <td>".$rows->{'apartment_number'}."</td>
            <td>".$rows->{'contact_email'}."</td>
            <td>".$rows->{'request_time'}."</td>
            <td>".$rows->{'request_content'}."</td>
            </tr>";
        }
        $res=$res."</table></div>";
        return $res;
    }

}
