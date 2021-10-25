<?php

namespace Modules\FacebookPost\Entities;

use Illuminate\Database\Eloquent\Model;

class Messageroot extends Model
{
    protected $table = 'messageroots';
    protected $fillable = 
    [
    	'f_uid',
    	'f_pid',
    	'object_id',
    	'user_id',
    	'lead_id'
    ];
   public function messagelist(){
        return $this->hasMany('Modules\FacebookPost\Entities\Messagelist','messageRoot_id', 'id');
    }
    public static function updateOrCreatedata($requestData){
       try{   
       		$rows = [];
       		$rows['f_uid'] = $requestData['f_uid'];
       		$rows ['f_pid'] = $requestData['f_pid'];
       		$rows ['object_id'] = $requestData['object_id']; 
       		$rows ['user_id'] = $requestData['user_id'];         
            $messageroot = static::updateOrCreate(
            [
                'f_uid' => $rows['f_uid']
                
            ],
            [
            	'f_pid' => $rows['f_pid'],
                'object_id' => $rows ['object_id'],
                'user_id'  =>  $rows ['user_id']
            ]
        );
            return $messageroot;
           

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               
        }
    }
    
        public static function  findorinsert($id,$pid){
        $f_root = static::where('f_uid',$id)->where('f_pid',$pid)->first();
        if(!$f_root){
           $f_root= static::create(['f_uid' => $id,'f_pid' => $pid]);
           return $f_root->id;
        }
        else{
        return $f_root->id;
            
        }
    }
}
