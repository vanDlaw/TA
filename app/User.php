<?php

namespace App;

use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imei', 'mac', 'pin', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public static function adduser($imei,$pin){
      try{
        $item=User::where('imei',$imei)->first();
        if($item == null){
          $item = new User();
          $item->imei = $imei;
          $item->pin =$pin;
          $item->save();
        }
      }catch(Exception $e){
        dd($e);
      }
      return $item;
    }

  public static function getlocation($pin){
    $item=User::where('pin',$pin)->first();
    return $item;
  }


  public static function savelocation($pin, $lat,$long){
    $item = User::where('pin',$pin)->first();
    $item->longitude =$long;
    $item->latitude = $lat;
    $item->save();

    return $item;
  }

  public static function setToken($pin, $token){
    $item = User::where('pin',$pin)->first();
    $item->token =$token;
    $item->save();
  }
}
