<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Customer extends Model
{
    protected $fillable = [
        'customer_id', 'name','email','vat_number', 'phone','company','position','website','address','city','state','zip_code','country_id','shipping_is_same_as_billing','shipping_address','shipping_city','shipping_state','shipping_zip_code','shipping_country_id','default_language','currency_id','inactive','assigned_to','converted_from','created_by','created_at','updated_at','deleted_at','customer_source_id','social_id_link'
    ];
    public function country(){
        return $this->belongsTo('\App\Models\Country');
    }
    public function assigned()
    {
        return $this->belongsTo(User::class ,'assigned_to','id')->select('id','name');
    }
    public function source(){
        return $this->belongsTo('Modules\Lead\Entities\LeadSource','customer_source_id','id');
    }
    public static function getCustomerById($customer_id){
        $customer=static::whereId($customer_id)->with('country','assigned','source')->first();
        if(!$customer->email){
            $customer->email = 'N/A';
        }

        $customer->country->name = __('countries.'.$customer->country->name);

        return $customer;
    }
    public static function get_customersdata(){
        $customer=static::select(DB::raw('name,email,country_id,phone,company,vat_number,website,address,city,state,zip_code'))->with('country')->get();
        return $customer;
    }

    public static function createCustomer($requestData){
        
        try{
            
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }


    public static function updateCustomer($requestData,$customer_id){

        try{
            $customer=static::find($customer_id);
            $customer->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }



}
