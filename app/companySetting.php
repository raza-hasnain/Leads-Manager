<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companySetting extends Model
{
       protected $fillable=['name','phone_code','phone_no','address','city','postal_code','country_id','updated_by', 'logo','logo_sm','icons','copy_right','footer_container'];


    public static function updateOrganization($requestData){
        try{

            $organization=static::find(1);
            $organization->fill($requestData)->save();

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }
}
