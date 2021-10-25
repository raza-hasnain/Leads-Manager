<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
	   use SoftDeletes;
	   protected $table = 'invoicestatus';

     protected $fillable = ['name','icon'];
        protected $dates = ['deleted_at'];

     public function Invoice(){
        return $this->hasMany('Modules\Sales\Entities\Invoice','status_id','id');
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
