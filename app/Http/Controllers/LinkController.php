<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sales\Entities\Estimate;
use Modules\Customer\Entities\Customer;
use Modules\Lead\Entities\Lead;
use App\Models\Country;
class LinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */    
    public function estimate_link($estimate_number)
    {
        $estimate=Estimate::with('country','estimate_items')->where('estimate_number',$estimate_number)->first();
        return view('estimate',compact('estimate'));
    }
    public function customer_invite(Request $request,$source=null)
    {
        if($request->isMethod('post')){
            try{
                $request->validate([
                'email'=>'required',
                'country_id'=>'required|numeric',
                'name' => 'required',
                'phone'=>'required|numeric',
                'company'=>'',
                'website'=>'',
                'address'=>'',
                'country_code'=>'required',
                'zip_code'=>'',
                'city'=>''
                ]);
                $data=$request->all();
                $data['customer_source_id']= $source;
                $data['customer_id']= generateRandomStr();
                $save = Customer::createCustomer($data);
                return response()->json(['status'=>'success'], 200);exit;
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $country=Country::countriesTranslated();
            $source_id=$source;
            if($source_id==null){
                $source_id=2;
            }
            return view('customer_invite',compact('country','source_id'));exit;
        }
        
    }
    public function lead_invite(Request $request,$source=null)
    {
        if($request->isMethod('post')){
            try{
                $request->validate([
                'first_name' => 'required',
                'email'=>'required',
                'country_id'=>'required|numeric',
                'phone'=>'required|numeric',
                'company'=>'',
                'website'=>'',
                'address'=>'',
                'country_code'=>'required',
                'zip_code'=>'',
                'city'=>''
                ]);
                $data=$request->all();
                $data['lead_source_id']= $source;
                $data['lead_status_id']= 1;
                $data['lead_id']= generateRandomStr();
                $save = Lead::createLead($data);
                return response()->json(['status'=>'success'], 200);exit;
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $country=Country::countriesTranslated();
            $source_id=$source;
            if($source_id==null){
                $source_id=1;
            }
            return view('lead_invite',compact('country','source_id'));exit;
        }
        
    }
}
