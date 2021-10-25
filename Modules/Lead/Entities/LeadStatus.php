<?php

namespace Modules\Lead\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadStatus extends Model
{
	use SoftDeletes;

    protected $fillable = ['name','icon'];
    protected $dates = ['deleted_at'];
    
    public function leads(){
        return $this->hasMany('Modules\Lead\Entities\Lead');
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
