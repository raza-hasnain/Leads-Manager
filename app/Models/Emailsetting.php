<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emailsetting extends Model
{
    protected $fillable=['driver','host','port','encryption','form_address','form_name','username','password'];

    public static function createemail($requestData){
        
        try{
            static::create($requestData);            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }
     public static function updateEmail($requestData,$customer_id){

        try{
            $customer=static::find($customer_id);
            $customer->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
