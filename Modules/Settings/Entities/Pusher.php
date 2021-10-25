<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class Pusher extends Model
{
    protected $table = 'pusher_settings';
    protected $fillable = ['pusher_app_key','pusher_app_id','pusher_app_secret','pusher_app_cluster','options'];
    public static function createPusher($requestData){ 
        try{
            
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
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
