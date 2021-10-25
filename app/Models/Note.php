<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	 protected $fillable = [
      'description','create_by','module_id','module_member_id','member_type','created_at','updated_at'
    ];

    public static function createNote($requestData){
        
        try{
            
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }
    public function user(){
        return $this->belongsTo('\App\User','create_by','id');
    }

    public static function updateNote($requestData,$id){
            try{
            $task=static::find($id);
            $task->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
