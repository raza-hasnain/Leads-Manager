<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimateStatus extends Model
{
        use SoftDeletes;
     protected $fillable = ['name','icon'];
        protected $dates = ['deleted_at'];
    public function estimates(){
        return $this->hasMany('Modules\Sales\Entities\Estimate','status_id','id')->where('type',0);
    }
    public function proposals(){
        return $this->hasMany('Modules\Sales\Entities\Estimate','status_id','id')->where('type',1);
    }  
    
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
