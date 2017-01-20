<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    public function daftar(Request $req){

      //dd($req->all());
      $output['task']="Add New User";
      $output['status']="500";
      $output['message']="error";

      $imei=$req->input("imei");
      $pin=$this->gen_uid(6);

      $item=User::adduser($imei,$pin);

      if($item != null){
        $output['status']="200";
        $output['message']="success";
        $output['data']=$item->pin;
      }else{
		$output['status']="400";
        $output['message']="Error";
        $output['data']=$imei;
      }
      return response()->json($output);
    }

    public function lokasi(Request $req){
      $output['task']="Add Location";
      $output['status']="500";
      $output['message']="error";

      $latitude=$req->input("latitude");
      $longitude=$req->input("longitude");
      $pin=$req->input("pin");

      $item =User::savelocation($pin,$latitude,$longitude);

      $output['status'] = "200";
      $output['message'] = $item;

      return response()->json($output);
    }

    public function token(Request $req){
      $output['task']="Set Token";
      $output['status']="500";
      $output['message']="error";

      $token = $req->input("token");
      $pin = $req->input("pin");

      $item = User::setToken($pin, $token);

      $output["status"] = "200";
      $output["message"] = $item;
      return response()->json($output);
    }
    
    public function getPos(Request $req, $pin){
      $output['task']="Get Location";
      $output['status']="500";
      $output['message']="error";
      $item =User::getlocation($pin);
      if ($item == null){
        $output['status']="400";
      }else{
        $output['status']="200";
        $output['message']='success';
        $output['data']['pin']=$pin;
        $output['data']['latitude']=$item->latitude;
        $output['data']['longitude']=$item->longitude;
      }
      return response()->json($output);
    }


    public function gen_uid($l=10){
    return substr(str_shuffle("123456789ABCDEFGHIJKLMNPQRSTUVWXYZ"), 0, $l);
    }
}
