<?php

namespace Modules\Lead\Entities;
use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class Lead extends Model
{
    protected $fillable = ['first_name','last_name','lead_id','email','phone','social_id_link','company','position','website','address','city','state','zip_code','description','summary','country_id','lead_status_id','lead_source_id','created_by','assigned_to','last_contacted','last_contacted_by','is_lost'];

    public function country(){
        return $this->belongsTo('\App\Models\Country','country_id','id');
    }
    public function status(){
        return $this->belongsTo('Modules\Lead\Entities\LeadStatus','lead_status_id','id');
    }
    public function source(){
        return $this->belongsTo('Modules\Lead\Entities\LeadSource','lead_source_id','id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class ,'assigned_to','id')->select('id','name');
    }
    public function contacted()
    {
        return $this->belongsTo(User::class ,'last_contacted_by','id')->select('id','name');
    }


    public static function get_leadsdata(){
        $leads=static::select(DB::raw('first_name,last_name,email,country_id,phone,social_id_link,company,position,website,address,city,state,zip_code,lead_status_id,lead_source_id,assigned_to'))->with('country','status','source','assigned')->get();
        return $leads;
    }

    public static function createLead($requestData){
        
        try{
            $save = static::create($requestData); 
            return $save;            
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);               
        }
    }
    public static function getLeadById($lead_id){
        $lead=static::whereId($lead_id)->with(['country' => function ($q) {
            $q->select(DB::raw('id,name,country_code'));
            },'status','assigned','contacted'])->first();
        if(!isset($lead->email)){
            $lead->email = 'N/A';
        }
        return $lead;
    }

    public static function updateLead($requestData,$lead_id){

        try{
            $lead=static::find($lead_id);
            $lead->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }

}
