<?php

namespace Modules\FacebookPost\Entities;

use Illuminate\Database\Eloquent\Model;

class Messagelist extends Model
{
     protected $table = 'messagelists';
    protected $fillable = [
    	'message_id',
    	'message',
    	'time',
    	'messageRoot_id',
    	'send_id',
    	'seen',
    	'seen_by'
    ];

    public static function updateOrCreatedata($requestData){
       try{   
       		$rows = [];
       		$rows['message_id'] = $requestData['message_id'];
       		$rows ['message'] = $requestData['message'];
       		$rows ['messageRoot_id'] = $requestData['messageRoot_id']; 
       		$rows ['send_id'] = $requestData['send_id'];
       		$rows ['seen'] = 0; 
       		$rows ['seen_by'] = $requestData['seen_by'];         
            $messageroot = static::updateOrCreate(
            [
                'message_id' => $rows['message_id']
            ],
            [
                'message' => $rows ['message'],
                'messageRoot_id'  =>  $rows ['messageRoot_id'],
                'send_id'  =>  $rows ['send_id'],
                'seen'  =>  $rows ['seen'],
                'seen_by'  =>  $rows ['seen_by']

            ]
        );
            return $messageroot->id;

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               
        }
    }
       public static function  createMessage($requestData){
        try{
       $message = static::create(
        $requestData);
       return $message;
     }
     catch(\Exception $e){
      throw new \Exception($e->getMessage(), 1); 
     }

    }
}
