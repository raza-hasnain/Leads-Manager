<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Lead\Entities\Lead;
use Modules\Customer\Entities\Customer;
use Modules\Sales\Entities\Estimate;
use Modules\Sales\Entities\EstimateItem;
use Modules\Sales\Entities\EstimateStatus;
use Modules\Sales\Entities\EstimateSource;
use App\Models\Country;
use App\Models\Currency;
use App\User;
use Modules\Sales\Http\Requests\EstimateUpdateRequest;
use Modules\Sales\Http\Requests\EstimateStoreRequest;

use App\Exports\LeadExport;
use App\Imports\LeadImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PDF;
use DataTables;
use DB;
use App\Models\Module;
use App\Http\Controllers\BaseController;
use Modules\Sales\Entities\InvoiceStatus;
use Modules\Sales\Entities\Payment;

class EstimateController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
         if(!$this->user->can('browse_estimates',app('Modules\Sales\Entities\Estimate'))){
            return redirect()->route('home')->with('flash',array('status'=>'error','message'=>'permission denied'));
        }
        $data = Estimate::with('status')->where('type',0)->get();
        $statuses = EstimateStatus::withCount('estimates')->get();
        $this->status = $statuses;
        if ($request->ajax()) {          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                      $btn ="";
                        $btnDel ="";
                        $btn_view ='';
                        $btn_edit ='';

                                if($this->user->can('own_estimates',app('Modules\Sales\Entities\Estimate')) && $row->created_by == $this->user->id ){
                                             $btn_view ='"<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i>'.__('layout.view_details').'</a></li>"'; 
                                             $btn_edit ='" <li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li>';
                                            $btnDel = '<button class="btn btn-light delete-tr float-left" id="delete-tr-'.$row->id.'"><i class="fas fa-times"></i></button>';  
                                }
                             
                                if($this->user->can('view_estimates',app('Modules\Sales\Entities\Estimate')) ){
                                             $btn_view ='<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i>'.__('layout.view_details').'</a></li>';  
                                }
                            if($this->user->can('edit_estimates',app('Modules\Sales\Entities\Estimate'))){
                                            $btn_edit ='<li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li></li>';  
                                }
                        if($this->user->can('delete_estimates',app('Modules\Sales\Entities\Estimate'))){
                                         
                            $btnDel = '<button class="btn btn-light delete-tr float-left" id="delete-tr-'.$row->id.'"><i class="fas fa-times"></i></button>';
                        }
                          $btn = '<div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            '.$btn_view.$btn_edit.'
                                          
                                        </ul>
                                </div>';
                            return $btn.$btnDel;
                        
                            
                    })
                    ->addColumn('input',function($row){
                            $input = '<input type="checkbox" class="data-input ml-1"  name="data[]"  value="'.$row->id.'" >';
                            return $input;
                    })->editColumn('send_to',function($row){
                        return clean($row->send_to);
                    })
                    ->editColumn('status.name', function ($row) {
                         $data = '<div class="float-left">'.clean($row->status->name).'</div>';
                            $dropdown ='<div class="dropdown float-right p-0" id="no-padding" data-toggle="dropdown">
                                <a href="#" class="dropdown-toggle"><i class="ti-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">';
                                $dropdowndata = ''; 
                             
                        foreach( $this->status as $status){
                             $dropdowndata .= '<li><a onClick="editEstimateStatus('.$row->id.','.$status->id.')">'.clean($status->name).'</a></li>';  
                        }
                        
                     $dropdownend = '</div>';

                  return $data.$dropdown.$dropdowndata.$dropdownend;
           })->editColumn('title',  function ($row){
               return clean($row->title);
           })
                    ->rawColumns(['action','input','status.name','title'])
                    ->make(true); exit;
        }
        $total = $data->count();
        return view('sales::estimate.index',compact('total','statuses'));
    }
    public function statistics()
    {
        $total = Estimate::where('type',0)->count();
        $statuses = EstimateStatus::withCount('estimates')->get();
        return view('sales::estimate.statistics',compact('total','statuses'));
    }
     public function create(Request $request){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
           
                if($request->has('description')){
                  $request->validate([
          'title' => 'required',
            'status_id' => 'required',
            'module_id' => 'required',
            'module_member_id' => 'required',
            'open_date' => 'required',
            'expiry_date' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            'description.*' => 'required',
            'long_description.*' => 'required',
            'quantity.*' => 'required',
            'rate.*' => 'required',
         
             ],[
        'description.*.required' => __('msg.items_required'), 
    'long_description.*.required' => __('msg.description_required'),
     'quantity.*.required' => __('msg.quantity_required'),
     'rate.*.required' => __('msg.rate_required'),
     
    ]);
            }
            else{
                
                return response()->json(['errors'=> ['items'=>  __('layout.no_items_add')]], 322);exit;
            }
                $data = $request->all();
                $str = $data['title'];
                $data['url_slug'] = preg_replace('/\s+/', '-', $str);
                $data['estimate_number']= generateRandomStr();
                $data['type']= 0;
                $data['created_by']= $request->user()->id;
                $estimate = Estimate::createEstimate($data);
                foreach ($data['description'] as $key => $value) {
                if (!empty($value)) {
                    $item = new EstimateItem;
                    $item->estimate_id = $estimate;
                    $item->description = $value;
                    $item->item_id = $data['item_id'][$key];
                    $item->long_description = $data['long_description'][$key];
                    $item->quantity = $data['quantity'][$key];
                    $item->rate = $data['rate'][$key];
                    $item->sub_total = $data['sub_total'][$key];
                    $item->save();
                }
            }
                return response()->json(['status'=>'success'], 200);
          
        }else{
            $statuses = EstimateStatus::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $sources = EstimateSource::select(DB::raw('id,module_name,module_model'))->orderBy('id', 'DESC')->get();
            $country=Country::countriesTranslated();
            return view('sales::estimate.create',compact('country','statuses','sources'));exit;
        }
    }

    public function getmodule($module_id)
    {
        $get_model = EstimateSource::select('module_model')->findOrFail($module_id);
        $module= $get_model->module_model;
        
        $module_name = strstr($module,'Lead\Entities\Lead');
        if ($module_name != false) {
            $get_members = $module::select('id',DB::raw("CONCAT(first_name) as text"))->whereNull('is_lost')->get();
        }else{
            $get_members = $module::select(DB::raw('id, name as text'))->get();
        }
        $module_members=json_encode($get_members);
        return $module_members ;
    }
    public function getmodulemember($module_id,$member_id)
    {
        $country = Country::get();
        $get_model = EstimateSource::select('module_model')->findOrFail($module_id);
        $module= $get_model->module_model;
        $member = $module::whereId($member_id)->with('country')->first();
        return view('sales::estimate.estimate_to',compact('member','country'));
    }

    public function editEstimateStatus(Request $request,$estimate_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        try{
            $data = $request->all();
            Estimate::updateEstimate($data,$estimate_id);
            return response()->json(['status'=>'success'], 200);
        }
        catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }

    public function viewEstimate($estimate_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('view_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);
			  }
			  
			  
        $statuses = EstimateStatus::get();
        $estimate= Estimate::getestimateById($estimate_id);
       
        
        return view('sales::estimate.viewestimate',compact('estimate','statuses')) ;
    }  
    public function editEstimate(Request $request,$estimate_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
          
                if($request->has('description')){
                  $request->validate([
         'title' => 'required',
          
            'open_date' => 'required',
            'expiry_date' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            'description.*' => 'required',
            'long_description.*' => 'required',
            'quantity.*' => 'required',
            'rate.*' => 'required',
         
             ],[
        'description.*.required' => __('msg.items_required'), 
    'long_description.*.required' => __('msg.description_required'),
     'quantity.*.required' => __('msg.quantity_required'),
     'rate.*.required' => __('msg.rate_required'),
     
    ]);
            }
            else{
                return response()->json(['errors'=> ['items'=>  __('layout.no_items_add')]], 322);exit;
            }
                $data=$request->all();
                Estimate::updateEstimate($data,$estimate_id);
                EstimateItem::where('estimate_id',$estimate_id)->delete();
                foreach ($data['description'] as $key => $value) {
                if (!empty($value)) {
                    $item = new EstimateItem;
                    $item->estimate_id = $estimate_id;
                    $item->description = $value;
                    $item->item_id = $data['item_id'][$key];
                    $item->long_description = $data['long_description'][$key];
                    $item->quantity = $data['quantity'][$key];
                    $item->rate = $data['rate'][$key];
                    $item->sub_total = $data['sub_total'][$key];
                    $item->save();
                }
            }
                return response()->json(['status'=>'success'], 200);
          
        }else{
            $country = Country::get();
            $statuses = EstimateStatus::get();
            $estimate = Estimate::with('estimate_items','source')->whereId($estimate_id)->first();
            $model = $estimate->source->module_model;
            $member = $model::whereId($estimate->module_member_id)->first();
            return view('sales::estimate.edit',compact('statuses','country','estimate','member'));
        }
    }
    public function deleteEstimate(Request $request,$estimate_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('delete_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        try{
            $estimate=Estimate::findOrFail($estimate_id);
            $estimate_items=EstimateItem::where('estimate_id',$estimate_id)->get();
            foreach ($estimate_items as $item) {
                $item->delete();
            }
            $estimate->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
  public function export_pdf($estimate_id)
  {
    $estimate = Estimate::where('id',$estimate_id)->with('estimate_items','status')->first();
    $pdf = PDF::loadView('sales::estimate.estimate_pdf', compact('estimate'));
    $pdf->getDomPDF()->setHttpContext(
        stream_context_create([
            'ssl' => [
                'allow_self_signed'=> TRUE,
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
            ]
        ])
    );
     $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("estimate.pdf");
 
    }
    
     /**
         * count lead convert form 
         */
         public function countConvertEstimate(){
            $estimate_total = Estimate::where('type',0)->count();
           
           
            $estimateCount = Estimate::where('status_id',5)->where('type',0)->count();
           return response()->json(['status'=>'success', 'estimate_total'=>$estimate_total,'estimateCount'=> $estimateCount], 200);
        exit; 
         }
         
     public function setting(){
           $statuses = EstimateStatus::select(DB::raw('id, name,status'))->orderBy('id', 'DESC')->get();
            $sources = EstimateSource::select(DB::raw('id, module_name'))->orderBy('id', 'DESC')->get();
               $InvoiceStatus = InvoiceStatus::select(DB::raw('id, name,status'))->orderBy('id', 'DESC')->get();
             $paymentsource = Payment::select(DB::raw('id, title'))->orderBy('id', 'DESC')->get();

      return view('sales::setting.setting',compact('statuses','sources','InvoiceStatus','paymentsource'));exit;
         }
         
         public function add_status(Request $request,$id =null)
                {
        if($request->isMethod('post')){
           
              if(isset($request->id)){
                   $request->validate([
			   'name' => 'required',
			   
			]);
                   $data['name']=$request->name;
             $data['icon']=$request->icon_class.' '.$request->color;
                  if($request->icon_class ==null){
                      unset($data['icon']);
                  }
          $save = EstimateStatus::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
         }
         else{
             $request->validate([
			   'name' => 'required',
			   'icon_class' => 'required',
			]);
			
			$data['name']=$request->name;
             $data['icon']=$request->icon_class.' '.$request->color;
             $save = EstimateStatus::createstatus($data);
         $msg = __('msg.add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
       }
                        
            
        }
        else{
            if($id==null){
                return view('sales::setting.edit_status');exit;
            }
            else{
                $status = EstimateStatus::where('id',$id)->first();
                 return view('sales::setting.edit_status',compact('status'));exit;
            }
       
        
    }

        }
        
              public function add_source(Request $request,$id =null)
                {
        if($request->isMethod('post')){
           
            $value = explode("_",$request->lead_status_id);
            $data['module_name'] = $value[0];
            $data['module_model'] = $value[1];
             if($data['module_name'] ==  'Customers'){
                
                $id = EstimateSource::find(1);

                if($id !=null){
                 return response()->json(['errors'=> ['items'=>  __('layout.modules_insert_before')]], 322);exit;
             }
             else{
                $data['id'] = 1;
             }
                
            }
            else if($data['module_name'] == 'Leads'){
            
                    $id = EstimateSource::find(2);

                if($id !=null){
                 return response()->json(['errors'=> ['items'=>  __('layout.modules_insert_before')]], 322);exit;
             }
             else{
                $data['id'] = 2;
             }
            }
            
             $request->validate([
               'lead_status_id' => 'required',
               

            ]);
             
            
              if(isset($request->id)){
          $save = EstimateSource::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
         }
         else{
             $save = EstimateSource::createstatus($data);
         $msg = __('msg.create_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
       }
                        
            
        }
        else{
            $modulesName = Module::get();
            if($id==null){
                return view('sales::setting.edit_source',compact('modulesName'));exit;
            }
            else{
              
                $status = EstimateSource::where('id',$id)->first();
                 return view('sales::setting.edit_source',compact('status','modulesName'));exit;
            }
       
        
    }

        }
        
           public function deletestatus(Request $request,$id){
        try{
            $lead=EstimateStatus::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    
        public function deletesource(Request $request,$id){
        try{
            $lead=EstimateSource::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    
    public function editcusEstimateStatus($estimate_id,$status_id){
        try{
            $status= $status_id;
            if($status == 1){
                $estimate_st = EstimateStatus::select(DB::raw('id'))->where('status',1)->first();
            }else{
                $estimate_st = EstimateStatus::select(DB::raw('id'))->where('status',0)->first();
            }
            $status_nid = $estimate_st->id;
            Estimate::where('estimate_number',$estimate_id)->update(['status_id'=>$status_nid,'accepted_date' =>  \Carbon\Carbon::now()]);
            $module = Estimate::select(DB::raw('module_id'))->where('estimate_number',$estimate_id)->first();
            $module_id =$module->module_id;
            return response()->json(['status'=>'success','module_id'=>$module_id], 200);
        }
        catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }
}
