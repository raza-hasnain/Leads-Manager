<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
	protected $table = 'invoiceDetails';
    protected $fillable = ['invoice_id','payment_id','amount','due','title','refernce_number','title_number','swift_no','made_by'];
     public function invoice(){
        return $this->belongsTo('Modules\Sales\Entities\Invoice','invoice_id','id');
    }
     public function payment(){
        return $this->belongsTo('Modules\Sales\Entities\Payment','payment_id','id');
    }

       public static function created_Invoicedetails($requestData)
    {
         try{
           $createestimate =  static::create($requestData);
           return $createestimate->id;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
        public function user(){
        return $this->belongsTo('\App\User','made_by','id');
    }
}
