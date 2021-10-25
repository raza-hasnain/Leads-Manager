<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
   protected $fillable = [
        'title', 'description','priorities_id','status_id', 'start_date','deadline','assigned','create_by','module_id','module_member_id','member_type','seen','created_at','updated_at'
    ];

    public static function createTask($requestData){
        
        try{
            
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }
    public static function updateTask($requestData,$id){
            try{
            $task=static::find($id);
            $task->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
    public function status(){
        return $this->belongsTo('\App\Models\Task_status');
    }
     public function priorities(){
        return $this->belongsTo('\App\Models\Prioritie');
    }
     public function user(){
        return $this->belongsTo('\App\User','create_by','id');
    }
}
