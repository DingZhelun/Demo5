<?php

namespace App\Http\Controllers;

use App\Model\Subdivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;
use Symfony\Component\Console\Input\Input;


class signupController extends Controller
{
    //
    public function signup() {
        return view('signup');
    }

    public function getBuilding(Request $request){
//        $subdivision = Input::get('subdivision');
//        $role = Input::get('role');
//        $subdivision = "BaoLi";
//        $role = "Subdivision";
        $input = $request->except("_token");
        $subdivision = $input['subdivision'];
        $role = $input['role'];

        $sql="";

        switch ($role){
            case "Subdivision":
                $sql = "select available
                        from Subdivisions
                        where subdivision_name = '$subdivision';";
                break;
            case "Building":
                $sql = "select building_number
                        from Subdivisions , Buildings
                        where subdivision_name='$subdivision' and Subdivisions.subdivision_id = Buildings.subdivision_id and Buildings.available=1;";
                break;
            case "Apartment":
                $sql = "select building_number
                        from Subdivisions , Buildings
                        where subdivision_name='$subdivision' and Subdivisions.subdivision_id = Buildings.subdivision_id;";
                break;
        }
        $result = DB::select($sql);
        $arr = array();
        foreach ($result as $r) {
            $arr[] = $r;
        }
        return json_encode($arr);

    }

    public function getApartment(Request $request){
        $input = $request->except("_token");
        $subdivision = $input['subdivision'];
        $building_number = $input['building_number'];

        $sql = "select apartment_number
                from Subdivisions,Buildings,Apartments
                where Subdivisions.subdivision_name='$subdivision'
                and Subdivisions.subdivision_id = Buildings.subdivision_id
                and Apartments.building_id = Buildings.building_id
                and Apartments.available=1
                and Buildings.building_number='$building_number';";
        $result = DB::select($sql);
        $arr = array();
        foreach ($result as $r) {
            $arr[] = $r;
        }
        return json_encode($arr);
    }
    public function getService(Request $request){
        $input = $request->except("_token");
        $subdivision = $input['subdivision'];

        $sql = "select electricity,water,gas
        from Subdivisions
        where subdivision_name='$subdivision';";

        $result = DB::select($sql);
        $arr = array();
        foreach ($result as $r) {
            $arr[] = $r;
        }
        return json_encode($arr);

    }

    public function getEmail(Request $request){
        $input = $request->except("_token");
        $email = $input['email'];

        $sql = "select * from Contacts where contact_email='$email';";

        $result = DB::select($sql);
        $arr = array();
        foreach ($result as $r) {
            $arr[] = $r;
        }
        return json_encode($arr);
    }

    public function sendCode(Request $request){
        $input = $request->except("_token");
        $email = $input['email'];
        $name = $input['name'];
        $password = $input['password'];
        $phone = $input['phone'];
        $address = $input['address'];
        $role = $input['role'];

        $code=rand(100000,999999);
        $mail_body = "Your verification code is: $code, if not your own operation does not need to operate！";
        $flag = Mail::raw($mail_body, function ($message) use ($email) {
            $to = $email;
            $message ->to($to)->subject('Verification Code');
        });

            $sql = "select * from Contacts where contact_email='$email';";
            $result = DB::select($sql);
            $count = 0;
            foreach ($result as $r){
                $count++;
            }

            if ($count==0){
                $sql ="INSERT INTO `zxc9069_youareondefault`.`Contacts` (`contact_email`, `contact_name`, `contact_tel`, `password`, `role`, `address`, `available`, `token`) VALUES ('$email', '$name', '$phone', '$password', '$role', '$address', '0', '$code');";
                DB::insert($sql);
                return json_encode([0,"success"]);
            }else{
                $sql="UPDATE `zxc9069_youareondefault`.`Contacts` SET `contact_name` = '$name', `contact_tel` = '$phone', `password` = '$password', `role` = '$role', `address` = '$address', `available` = '0', `token` = '$code' WHERE (`contact_email` = '$email');";
                DB::update($sql);
                return json_encode([1,"success"]);
            }
    }

    public function register(Request $request){
        $input = $request->except("_token");
        $name=$input['name'];
        $email = $input['email'];
        $phone=$input['phone'];
        $address=$input['address'];
        $subdivision=$input['subdivision'];
        $building=$input['building'];
        $apartment=$input['apartment'];
        $water=$input['water'];
        $gas=$input['gas'];
        $electricity=$input['electricity'];
        $Internet=$input['Internet'];
        $role = $input['role'];
        $password = $input['password'];
        $code = $input['code'];

//        $name="ZhelunDing";
//        $email="zxd8813@mavs.uta.edu";
//        $phone="13126772577";
//        $address="QingDao";
//        $subdivision="May Flower";
//        //$building=$_POST['building'];
//        //$apartment=$_POST['apartment'];
//        $water="water ";
//        $gas="gas ";
//        $electricity="electricity ";
//        $Internet="Internet ";
//        $role = "Subdivision";
//        $password = "123456";
//        $code = 872272;

        $water = $water=="water "? 1:0;
        $gas = $gas=="gas "? 1:0;
        $electricity = $electricity=="electricity "? 1:0;
        $Internet = $Internet=="Internet "? 1:0;

        $sql ="select token from Contacts where contact_email='$email'";

        $rows = DB::selectOne($sql);
        foreach ($rows as $r){
            $result = $r;
            break;
        }
        if ($result==$code){
            $sql ="UPDATE `zxc9069_youareondefault`.`Contacts` SET `available` = '1' WHERE (`contact_email` = '$email');";
            DB::update($sql);

            switch ($role){
                case "Subdivision":
                    $sql = "UPDATE `zxc9069_youareondefault`.`Subdivisions`
                    SET `contact_email` = '$email',`available` = 0,`electricity` = '$electricity', `gas`='$gas',`water`='$water'
                    WHERE `subdivision_name`='$subdivision';";
                    DB::update($sql);
                    echo 1;
                    break;
                case "Building":
                    $sql = "UPDATE `zxc9069_youareondefault`.`Buildings`
                    SET `contact_email` = '$email',`available` = 0
                    WHERE (`building_number` = '$building' and `subdivision_id` in (select subdivision_id as name from Subdivisions where subdivision_name='$subdivision'));";
                    DB::update($sql);
                    echo 2;
                    break;
                case "Apartment":
                    $sql = "UPDATE `zxc9069_youareondefault`.`Apartments`
                    SET `contact_email` = '$email', `available` = '0', `electricity` = '$electricity', `water` = '$water', `gas` = '$water', `internet` = '$Internet'
                    WHERE (`apartment_number` = '$apartment' and `building_id` in (select building_id from Buildings where building_number='$building' and subdivision_id in (select subdivision_id from Subdivisions where subdivision_name='$subdivision')) );";
                    DB::update($sql);
                    echo 3;
                    break;
            }
        }else{
            echo 0;
        }
    }
}
