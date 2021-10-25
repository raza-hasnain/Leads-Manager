<?php

namespace Modules\FacebookPost\Entities;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = [
    	'app_id',
        'app_key',
        'version_key',
        'user_id',
        'scopes'
    ];


public static function createApp($requestData){
        try{
       $app = static::create(
        $requestData);
       return $app;
     }
     catch(\Exception $e){
      throw new \Exception($e->getMessage(), 1); 
     }

    }
  public static function updateApp($requestData,$id){

        try{
            $add=static::find($id);
            $add->fill($requestData)->save();
            return $add;
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }


}
