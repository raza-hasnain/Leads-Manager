<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remider extends Model
{
		 protected $table = 'remiders';
    protected $fillable = [
        'title', 'description','start_date','assigned','create_by','module_id','module_member_id','member_type','seen','created_at','updated_at'
    ];

    public static function createReminder($requestData){
        
        try{
            
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }
      public function user(){
        return $this->belongsTo('\App\User','assigned','id');
    }

      public static function updateReminder($requestData,$id){
            try{
            $task=static::find($id);
            $save = $task->fill($requestData)->save();
             return $task; 
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
