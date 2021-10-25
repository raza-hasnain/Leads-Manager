<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable=['name','parent_id','created_by','updated_by','created_at','updated_at'];

    public static function createRole($requestData){
        
        try{
            static::create($requestData);            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
     public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }


    public static function updateRole($requestData,$role_id){

        try{
            $role=static::findOrFail($role_id);
            $role->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
