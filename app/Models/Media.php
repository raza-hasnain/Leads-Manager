<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
     protected $fillable = [
        'pic_name',
        'source_address',
        'type',
        'user_id',
        
    ];


     public function user(){
        return $this->belongsTo('\App\User');
    }

      public static function createMedia($requestData){

        try{             
            $mediaid = static::create($requestData);
            return $mediaid;

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }

    public static function updateMedia($requestData,$media_id){
        try{

            $country=static::find($country_id);
            $country->fill($requestData)->save();

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }
    public static function allPic(){
        $all = static::get();
        return $all;
    }

}
