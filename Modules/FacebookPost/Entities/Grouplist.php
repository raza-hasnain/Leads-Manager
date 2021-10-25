<?php

namespace Modules\FacebookPost\Entities;

use Illuminate\Database\Eloquent\Model;

class Grouplist extends Model
{
    protected $fillable = [
    	'f_id',
        'name',
        'user_id',
    ];

    public static function updateOrCreategroup($requestData){
       try{   
       		$rows = [];
       		$rows['f_id'] = $requestData['id'];
       		
       		$rows ['name'] = $requestData['name']; 
       		$rows ['user_id'] = $requestData['user_id'];         
            $pagelist = static::updateOrCreate(
            [
                'f_id' => $rows['f_id']
            ],
            [
                'name'  =>  $rows ['name'],
                'user_id' => $rows ['user_id']
            ]
        );

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               
        }
    }
}
