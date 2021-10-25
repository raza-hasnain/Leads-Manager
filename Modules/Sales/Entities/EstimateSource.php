<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateSource extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','module_name','module_model'];
    protected $dates = ['deleted_at'];
    
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
