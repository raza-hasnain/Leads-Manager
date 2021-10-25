<?php

namespace Modules\Sales\Entities;

use App\User;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Estimate extends Model
{

    protected $fillable = ['type','title','url_slug', 'estimate_number','reference', 'module_id', 'module_member_id','send_to','email','phone_no','address', 'city','state','country_id','zip_code','shipping_address','shipping_city','shipping_state', 'shipping_zip_code','shipping_country_id','currency_id','discount_type_id','status_id', 'sales_agent_id','admin_note', 'client_note', 'terms_and_condition','open_date', 'expiry_date','show_quantity_as', 'sub_ptotal','discount_rate', 'discount_total','taxes', 'tax_total', 'adjustment', 'total','discount_method_id', 'created_by'];

    
    
  
    
    function created_user()
    {
        return $this->belongsTo(User::class ,'created_by','id')->select('id','name');
    }
    public function source(){
        return $this->belongsTo('Modules\Sales\Entities\EstimateSource','module_id','id');
    }    

    function customer()
    {
        return $this->belongsTo('Modules\Customer\Entities\Customer','customer_id','id');
    }
    function lead()
    {
        return $this->belongsTo('Modules\Lead\Entities\Lead','lead_id','id');
    }

    function sales_agent()
    {
        return $this->belongsTo(User::class ,'sales_agent_id','id')->select('id','name');      
    }
    function country(){
        return $this->belongsTo('\App\Models\Country','country_id','id');
    }

    function shipping_country()
    {
        return $this->belongsTo('\App\Models\Country','shipping_country_id','id');
    }
    function status(){
        return $this->belongsTo('Modules\Sales\Entities\EstimateStatus','status_id','id');
    }
    function estimate_items()
    {
        return $this->hasMany('Modules\Sales\Entities\EstimateItem');
    }
    public static function createEstimate($requestData){
        try{
           $createestimate =  static::create($requestData);
           return $createestimate->id;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function updateEstimate($requestData,$estimate_id){
        try{
            $estimate=static::find($estimate_id);
            $estimate->fill($requestData)->save();
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function getestimateById($estimate_id){
        $estimate=static::whereId($estimate_id)->with(['country' => function ($q) {
            $q->select(DB::raw('id,name,country_code'));
            },'estimate_items','created_user','status','source'])->first();
        if(!$estimate->email){
            $estimate->email = 'N/A';
        }
        return $estimate;
    }
}
