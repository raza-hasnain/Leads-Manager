<?php

namespace Modules\FacebookPost\Entities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Pagelist extends Model
{
    protected $fillable = [
    	'access_token',
        'f_id',
        'name',
        'user_id',

    ];

    public static function updateOrCreatedata($requestData){
       try{   
       		$rows = [];
       		$rows['f_id'] = $requestData['id'];
       		$rows ['access_token'] = $requestData['access_token'];
       		$rows ['name'] = $requestData['name']; 
       		$rows ['user_id'] = $requestData['user_id'];     
       		$updateorcreate = static::where('f_id',$requestData['id'])->where('user_id',$requestData['user_id'])->first();
       		if(!$updateorcreate){
       		    static::create($rows);
       		}
       		else{
       		    
            $updateorcreate->fill($rows)->save();
       		}
            

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               
        }
    }
    
}
