<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payment';
    protected $fillable = ['title','type','module_id'];

    public static function createstatus($requestData){
        
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