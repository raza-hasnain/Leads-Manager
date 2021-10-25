<?php

namespace Modules\Sales\Entities;
use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
	 protected $table = 'inovices';
    protected $fillable = ['type','invoice_number','url_slug', 'estimate_number','reference',  'customer_id','phone_no','address', 'city','state','country_id','zip_code','shipping_address','shipping_city','shipping_state', 'shipping_zip_code','shipping_country_id','currency_id','discount_type_id','status_id', 'sales_agent_id','admin_note', 'client_note', 'terms_and_condition','open_date', 'expiry_date','show_quantity_as', 'sub_ptotal','discount_rate', 'discount_total','taxes', 'tax_total', 'adjustment', 'total','discount_method_id', 'created_by'];

    
    
  
      public function InvoiceDetails(){
        return $this->hasMany('Modules\Sales\Entities\InvoiceDetails');
    }
    function created_user()
    {
        return $this->belongsTo(User::class ,'created_by','id')->select('id','name');
    }
    public function source(){
        return $this->belongsTo('Modules\Sales\Entities\InvoiceSource','module_id','id');
    }    

    function customer()
    {
        return $this->belongsTo('Modules\Customer\Entities\Customer','customer_id','id');
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
        return $this->belongsTo('Modules\Sales\Entities\InvoiceStatus','status_id','id');
    }
    function invoice_items()
    {
        return $this->hasMany('Modules\Sales\Entities\InvoiceItems');
    }
    public static function createInvoice($requestData){
        try{
           $createestimate =  static::create($requestData);
           return $createestimate->id;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function updateInvoice($requestData,$estimate_id){
        try{
            $estimate=static::find($estimate_id);
            $estimate->fill($requestData)->save();
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function getinvoiceById($estimate_id){
        $estimate=static::whereId($estimate_id)->with(['country','invoice_items','created_user','status','customer'])->first();
       
        return $estimate;
    }
}
