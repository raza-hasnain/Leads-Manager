<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
	protected $fillable=['name','country','iso','country_code','min_digits','max_digits','created_by','lang_name','lang_local','created_at','updated_at'];
    
    public static function getCountry(){
        return static::orderBy('name')->get();
    }

    public static function createCountry($requestData){

        try{             
            static::create($requestData);
        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }

    public static function updateCountry($requestData,$country_id){
        try{

            $country=static::find($country_id);
            $country->fill($requestData)->save();

        }catch(\Exception $e){   

            throw new \Exception($e->getMessage(), 1);               

        }
    }

    public static function getcountryby_name($country_name){
        $country=static::where('name', 'like',$country_name)->select(DB::raw('id'))->first();
        if ($country == null) {
            return null;
        }
        return $country->id;
    }
    public static function getcountryby_code($country_code){
        $country=static::where('country_code',$country_code)->select(DB::raw('id'))->first();
        if ($country == null) {
            return null;
        }
        return $country->id;
    }

    public static function countriesTranslated(){
        $countries = Country::orderBy('name')->get();

        foreach($countries as $country){
            $country->name = __('countries.'.$country->name);
        }

        return $countries;
    }
}
