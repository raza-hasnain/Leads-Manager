<?php

namespace Modules\Lead\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Customer\Entities\Customer;
use Modules\Sales\Entities\Estimate;
use Modules\Lead\Entities\Lead;
use Modules\Lead\Entities\LeadStatus;
use Modules\Lead\Entities\LeadSource;
use App\Models\Country;
use App\User;
use Modules\Lead\Http\Requests\UpdateRequest;
use Modules\Lead\Http\Requests\StoreRequest;

use App\Exports\LeadExport;
use App\Imports\LeadImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PDF;
use DataTables;
use DB;
use App\Http\Controllers\BaseController;
use Modules\FacebookPost\Entities\Messageroot;
use Spatie\Activitylog\Models\Activity;
use App\Models\Resolution;
use App\Models\Medium;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LeadController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
         if(!$this->user->can('browse',app('Modules\Lead\Entities\Lead'))){
            return redirect()->route('home')->with('flash',array('status'=>'error','message'=>'permission denied'));
        }
        $data = Lead::with('country','status','source','assigned')->whereNull('is_lost')->get();
        $statuses = LeadStatus::withCount('leads')->get();
        $this->status = $statuses;
        if ($request->ajax()) {          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ="";
                        $btnDel ="";

                           $btn ="";
                        $btnDel ="";
                        $btn_view ='';
                        $btn_edit ='';


                                if($this->user->can('own',app('Modules\Lead\Entities\Lead')) && $row->created_by == $this->user->id ){
                                             $btn_view ='"<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i>'.__('layout.view_details').'</a></li>"'; 
                                             $btn_edit ='" <li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li>
                                            <li><a class="px-2 cp update-tr" id="update-tr-'.$row->id.'"><i class="fas fa-leaf pr-1"></i> Update Status</a>
                                            </li>"';
                                            $btnDel = '<button class="btn btn-light delete-tr float-left" id="delete-tr-'.$row->id.'"><i class="fas fa-times"></i></button>';  
                                }
                             
                                if($this->user->can('view',app('Modules\Lead\Entities\Lead')) ){
                                             $btn_view ='<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i>'.__('layout.view_details').'</a></li>';  
                                }
                            if($this->user->can('edit',app('Modules\Lead\Entities\Lead'))){
                                            $btn_edit ='<li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i> '.__('layout.edit_details').'</a></li>';  
                                }
                        if($this->user->can('delete',app('Modules\Lead\Entities\Lead'))){
                                         

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
                    })
                    ->editColumn('name', function($row) {
                        $name = '<a class="view-tr cp" id="view-tr-'.$row->id.'">'.clean($row->first_name).' '.clean($row->last_name).'</a>';
                        return $name;
                    })
                    ->editColumn('assigned.name', function($row) {
                        $assigned_name = "";
                        if ($row->assigned_to == null) {
                           $assigned_name = "N/A";
                        }else{
                            $assigned_name = clean($row->assigned->name);
                        }
                        return $assigned_name;
                    })
                    ->editColumn('status.name', function ($row) {
                         $data = '<div class="float-left">'.clean($row->status->name).'</div>';
                            $dropdown ='<div class="dropdown float-right p-0" id="no-padding" data-toggle="dropdown">
                                <a href="#" class="dropdown-toggle"><i class="ti-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">';
                                $dropdowndata = ''; 
                             
                        foreach( $this->status as $status){
                             $dropdowndata .= '<li><a onClick="editleadStatus('.$row->id.','.$status->id.')">'.clean($status->name).'</a></li>';  
                        }
                        
                     $dropdownend = '</div>';

                  return $data.$dropdown.$dropdowndata.$dropdownend;
           })->editColumn('company',function($row){
               return clean($row->company);
           })->editColumn('source.name',function($row){
               return clean($row->source->name);
           })
                    ->rawColumns(['action','input','status.name','name','company'])
                    ->make(true); exit;
        }
        $total = $data->count();
        return view('lead::index',compact('total','statuses'));
    }


    public function statistics()
    {
        $total = Lead::count();
        $statuses = LeadStatus::withCount('leads')->get();
        return view('lead::statistics',compact('total','statuses'));
    }

    /**
     * Creates and stores a new lead.
     * @return Response
     */
    public function create(StoreRequest $request)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            try{  
                $data=$request->all();              
                $data['created_by']=$request->user()->id;
                $data['lead_id']= generateRandomStr();
               
                $save = Lead::createLead($data);
                return response()->json(['status'=>'success'], 200);exit;
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $statuses = LeadStatus::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $sources = LeadSource::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $users = User::select(DB::raw('id, name'))->where('status',1)->orderBy('id', 'DESC')->get();
            $country=Country::countriesTranslated();
            return view('lead::create',compact('country','statuses','sources','users'));exit;
        }
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function viewlead($lead_id)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('view',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        $lead=Lead::getLeadById($lead_id);
        return view('lead::show',compact('lead'));
    }

    public function getEstimates($module_id,$member_id)
    {
        $estimates=Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$member_id)->where('type',0)->get();
        return view('lead::estimates',compact('estimates'));
    }
    
    public function getProposals($module_id,$member_id)
    {
        $proposals=Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$member_id)->where('type',1)->get();
        return view('lead::proposals',compact('proposals'));
    }
     public function chatbox()
    {
        return view('lead::chat');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(UpdateRequest $request,$lead_id)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){

            try{  
                $lead=Lead::findOrFail($lead_id);
                $data=$request->all();  
                $data['updated_by']=$request->user()->id;
                Lead::updateLead($data,$lead_id);
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{
            $lead=Lead::getLeadById($lead_id);
            $statuses = LeadStatus::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $sources = LeadSource::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $users = User::select(DB::raw('id, name'))->where('status',1)->orderBy('id', 'DESC')->get();
            $country=Country::countriesTranslated();
            return view('lead::edit',compact('lead','country','statuses','sources','users'));exit;
            
        }
    }

    /**
     * Update the Lead Status.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editLeadStatus(Request $request,$lead_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        try{
            
            $data = $request->all();
            Lead::updateLead($data,$lead_id);
            return response()->json(['status'=>'success'], 200);
        }
        catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }
    /**
     * Exports the Leads.
     * @param Request $request
     * @param int $id
     * @return Response
     */

    public function export_excel_file() 
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        $permisionmsg =  __('layout.permission_denied');
       
       $filedownload = $excel = Excel::download(new LeadExport, 'leads.xlsx');
      ob_end_clean();
      return $filedownload;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_csv_file() 
    {
           $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        $excel = Excel::download(new LeadExport, 'leads.csv');
        ob_end_clean();
        return $excel;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_pdf_file() 
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
          $pdf_style = '<style>
            *{
        font-size:14px;
            }
          table, th, td {
  border: 1px solid black;
   border-collapse: collapse;
}
        </style>';
        $title = "<h2 style= 'width:100%; text-align: center;'>".__('menu.Leads')."</h2>";
      
        $leads = Lead::get_leadsdata();
        $pdf = PDF::loadView('lead::leads',compact('leads','title','pdf_style'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("leads.pdf");
    }

    public function print_file() 
    {
          $permisionmsg =  __('layout.permission_denied');
         if(!$this->user->can('export',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg ], 401);exit;
			  }
        $pdf_style = '<style>
            *{
        font-size:14px;
            }
          table, th, td {
  border: 1px solid black;
   border-collapse: collapse;
}
        </style>';
        $title = "<h2 style= 'width:100%; text-align: center;'>".__('menu.Leads')."</h2>";
        $leads = Lead::get_leadsdata();
        $pdf = PDF::loadView('lead::leads',compact('leads','pdf_style','title'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("leads.pdf", array("Attachment" => false));
    }



    public function import_file(Request $request,$file_type='')
    {
           $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            $request->validate([
                'import_file' => 'required',
                ]);
            try{
                $files = $request->file('import_file');  
                $import = Excel::import(new LeadImport,$files);
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   
        }else{
            $file_type_id = $file_type;
            return view('lead::import_file',compact('file_type_id'));exit;  
        }     
    }

    public function ConvertCustomer(Request $request,$lead_id=null)
    {
        if($request->isMethod('post')){
            
            
                $request->validate([
                 'email'=>'required|email|unique:customers'
                ]);
                 
                $data=$request->all();  
                 $lead=Lead::findOrFail($data['converted_form']);
                 $data['name'] = $lead->first_name.' '.$lead->last_name;
                  $data['address'] = $lead->address;
                $data['created_by']=$request->user()->id;
                $data['customer_id']= generateRandomStr();
                $save = Customer::createCustomer($data);
                $data1['is_lost'] = 1;
                Lead::updateLead($data1,$data['converted_form']);
                return response()->json(['status'=>'success'], 200);exit;
            }
        
        else{
            $lead = Lead::findOrFail($lead_id);
            $sources = LeadSource::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $country=Country::countriesTranslated();
            return view('lead::convert_customer',compact('country','sources','lead'));exit;
        }
    }

    public function addsummary(Request $request,$lead_id)
    {
        if($request->isMethod('post')){
            
            $request->validate([
                'summary' => 'required',
                ]);

            try{  
                $lead=Lead::findOrFail($lead_id);
                $data=$request->all(); 
                 $data['updated_by']=$request->user()->id;
                 $current_date  = Carbon::now();
                if($request->last_contacted)
        {

            $previous_date = new \DateTime($lead->last_contacted);           

            if($current_date > $previous_date)
            {
                // Update
                $data['last_contacted']      = $current_date->format('Y-m-d H:i:s');
                 $data['last_contacted_by']=$request->user()->id;
                  Lead::updateLead($data,$lead_id);
            }
        }
        else
        {
             $data['last_contacted']      = $current_date->format('Y-m-d H:i:s');
                 $data['last_contacted_by']=$request->user()->id;
                  Lead::updateLead($data,$lead_id);
        } 
                
                
              
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{

            $leadid=$lead_id;
            return view('lead::summary',compact('leadid'));exit;
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function deleteLead(Request $request,$lead_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('delete',app('Modules\Lead\Entities\Lead'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        try{
            $lead=Lead::findOrFail($lead_id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    public function download($file_type_id)
    {
        try {
           
              if ($file_type_id == 1) {
                $excel = Storage::download('excel/demo/leads.xlsx');
                  ob_end_clean();
        return $excel;
            }else{
                $csv = Storage::download('csv/demo/leads.csv');
                ob_end_clean();
        return $csv;
            }

        } catch (DecryptException $e) {
            //
            abort(404);
        }
    }
    
    /**
         * count lead convert form 
         */
         public function countConvertlead(){
            $lead_total = Lead::count();
            $id = LeadSource::where('name', 'Like', 'facebook')->select(DB::raw('id'))->first();
           
            $facebooCount = Lead::where('lead_source_id',$id->id)->count();
            

           return response()->json(['status'=>'success', 'lead_total'=>$lead_total,'facebooCount'=> $facebooCount], 200);
        exit; 
         }
         
            public function setting(){
           $statuses = LeadStatus::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $sources = LeadSource::select(DB::raw('id, name,status'))->orderBy('id', 'DESC')->get();

      return view('lead::setting.setting',compact('statuses','sources'));exit;
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
                 
                 
          $save = LeadStatus::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'leads'], 200);exit;
         }
         else{
                 $request->validate([
			   'name' => 'required',
			   'icon_class' => 'required',
			]);
			
			$data['name']=$request->name;
             $data['icon']=$request->icon_class.' '.$request->color;
             
             $save = LeadStatus::createstatus($data);
         $msg = __('msg.add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'leads'], 200);exit;
       }
                        
            
        }
        else{
            if($id==null){
                return view('lead::setting.edit_status');exit;
            }
            else{
                $status = LeadStatus::where('id',$id)->first();
                 return view('lead::setting.edit_status',compact('status'));exit;
            }
       
        
    }

        }
        
          public function add_source(Request $request,$id =null)
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
                 
                 
          $save = LeadSource::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-2','modules' =>'leads'], 200);exit;
         }
         else{
                $request->validate([
			   'name' => 'required',
			   'icon_class' => 'required',
			]);
			
			$data['name']=$request->name;
             $data['icon']=$request->icon_class.' '.$request->color;
             $save = LeadSource::createsource($data);
         $msg = __('msg.add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-2','modules' =>'leads'], 200);exit;
       }
                        
            
        }
        else{
            
           if($id==null){
                 return view('lead::setting.edit_source');exit;
            }
            else{
                $status = LeadSource::where('id',$id)->first();
                 return view('lead::setting.edit_source',compact('status'));exit;
            }
       
    }

        }
        
         public function deletestatus(Request $request,$id){
        try{
            $lead=LeadStatus::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    
        public function deletesource(Request $request,$id){
        try{
            $lead=LeadSource::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    public function convert(Request $request){
        
        try{  
                
                if($request->sourcs=='facebook'){
                    $data['lead_source_id'] = 2;
                }
                $data['first_name']=$request->name;
                $data['created_by']=$request->user()->id;
                $data['lead_id']= generateRandomStr();
                $social_id_link = Messageroot::where('object_id',$request->id)->first();
                $data['social_id_link'] = $social_id_link->f_uid;
                $leads = Lead::where('social_id_link',$data['social_id_link'])->first();
                if(!$leads){
                    $msg = __('msg.convert_successfully');
                $save = Lead::createLead($data);
                return response()->json(['status'=>'success','msg'=> $msg], 200);exit;
                }
                else{
                     $msg = __('msg.lead_create_before');
                    return response()->json(['status'=>'success','msg'=> $msg], 200);exit;
                }
                
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        
    }
    public function viewTask($id)
    {
        
       
        return redirect()->route('task.show', [2,$id]);

    }

     public function newTask($id)
    {
        
       
        return redirect()->route('task.new', [2,$id]);

    }

    public function viewNote($id){
      return redirect()->route('note.show', [2,$id]);
    }
     public function viewActive($id){
      $activities = Activity::with('causer')->where('log_name', '2'.'_'.$id)
    ->orderBy('id', 'DESC')->get();


      return view('layouts.active.show',compact('activities'));
    }
    public function viewReminder($id){
      return redirect()->route('reminder.show', [2,$id]);
    }
    public function newReminder($id)
    {
        
       
        return redirect()->route('reminder.new', [2,$id]);

    }
    public function newLogtouch(Request $request,$id =null)
    {
        
         if($request->isMethod('post')){
        $request->validate([
                     'medium'   =>  'required',
                     'date'     =>  'required',
                     
                     'resolution' =>  'required',


                ]);
            try{
                 $data = $request->all();
                $lead = Lead::where('id',$request->module_member_id)->first();
                $model_title_id = $request->module_member_id;
                  if(!$request->has('member_type')){
             $value =  __('menu.'.$this->modules[$request->module_id]['name']);
             $model_title = $request->module_id;
         }
         else{
            $data = __('menu.'.$this->modules[$request->module_id]['type'][$request->member_type]);
            $data1 =  __('menu.'.$this->modules[$request->module_id]['name']);
            $value = $data1.'('.$data.')';
            $model_title = $request->module_id.'_'.$request->member_type;
         }
        // Saving Data
        $str = "";
        $str .= $value. " :".clean($lead->first_name);
        $str .= "<br><br>";
        $str .= __('task.meduim') . " : ". clean($request->medium);
        $str .= "&nbsp, ";
        $str .= __('layout.date') . " : ". clean($request->date);
        
        $str .= "<br>";
        $str .= __('task.resolution') . " : ". clean($request->resolution);
        $str .= "<br>";
        $str .= __('layout.description') ;
        $str .= "<br>";
        $str .= clean($request->description);
   
        $current_date  = Carbon::now();
      
        
        if($lead->last_contacted)
        {

            $previous_date = new \DateTime($lead->last_contacted);           

            if($current_date > $previous_date)
            {
                // Update
                $lead->last_contacted       = $current_date->format('Y-m-d H:i:s');
                $lead->last_contacted_by    = auth()->user()->id;
                $lead->save();
            }
        }
        else
        {
            $lead->last_contacted       = $current_date->format('Y-m-d H:i:s');
            $lead->last_contacted_by    = auth()->user()->id;
            $lead->save();
        }
    
        
        $description = __('layout.entered_log_touch_for_lead');

        $log_name = $model_title.'_'.$model_title_id;
        log_activity($lead, trim($description), $str, $log_name);

        
         return response()->json(['status'=>'success'], 200);
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            
    }
    }
    else{
        $modul_id =2;
        $modul_member_id = $id;
        $module_type =null;
        $resolution = Resolution::get();
        $meduim = Medium::get();

        return view('layouts.active.add_logtouch',compact('modul_id','modul_member_id','module_type','resolution','meduim'));
    }
       
    }
    
    
    public function dasboard_statistics()
        {

        $data = Lead::get(); 
        $total = $data->count();
        $statuscount = countStatus($data,'lead_source_id');
        $info =[];
        $sources = LeadSource::select(DB::raw('id, name,icon'))->withCount('leads')->get();
       
     foreach ($sources as $source) {
          if(array_key_exists($source->id,$statuscount)){
            $info[$source->name] = $statuscount[$source->id];
          }
        }
        $dates = [];
        $startEnd = [];
        $currentdate = Carbon::now();
        for ($y=0; $y<=3; $y++){
        for ($i=0; $i<=6; $i++) {
        $dates['week_'.$y][] = $currentdate->subDays(1)->format('Y-m-d');
        }
        //end for loog
        $startEnd[$y] = Carbon::parse($dates['week_'.$y][6])->format('m/d').'-'.Carbon::parse($dates['week_'.$y][0])->format('m/d');

        foreach ($sources as $source) {
        $currentdate = Carbon::parse($dates['week_'.$y][6]);
        $data['week_'.$y] = Lead::whereBetween('created_at', [$dates['week_'.$y][6].' 00:00:00',$dates['week_'.$y][0].' 23:59:59'])->where('lead_source_id',$source->id )
        
        ->count();

          if($data['week_'.$y] !=0 ){
            $infoweek[$source->name][$y] = $data['week_'.$y];
          }
          else{
            $infoweek[$source->name][$y] = 0;
          }
        }
        //end foreach

    }
    //end for loop
         $sourcesdata = $sources->pluck('name')->toArray();
        
      
        return response()->json(['status'=>'success', 'data'=>$info,  'source' => $sourcesdata,  'total'=> $total,'data1' => $infoweek,'date' => $startEnd], 200);
        exit;
         }
         
         
      /*email send modal show*/

    function email_send(Request $request,$id = null, $estimate_number = null){
                   $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('send',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit; 
			  }
			  
		if($request->isMethod('post')){
        $request->validate([
                'email_send' => 'required',
                'subject' => 'required',
                'body' => 'required',

                ]);
      
        if($_ENV['MAIL_FROM_ADDRESS'] == 'null'){
             
                return response()->json(['errors'=> ['items'=>  __('layout.please_set_email_setting_first')]], 322);exit;
              }
               else{
               Mail::send('mailview',
             compact('request'), function($message) use($request)
               {
                  $message->from($_ENV['MAIL_FROM_ADDRESS']);
                  $message->subject($request->subject);
                      
                  $message->to($request->email_send);
                  if($request->has('type') && $request->type !='1'){
                  $message->attach(storage_path('app/'.$request->type.'.pdf'));
                  }
                  
               });
                return response()->json(['status'=>'success'], 200);exit;
            }
		}
		else{	
		    $route = 'lead.emailsend';
		       $module_id=2;
            $estimates = Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$id)->where('type',0)->get();
            $proposal = Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$id)->where('type',1)->get();
          
            $customer=Lead::findOrFail($id);
            $email = $customer->email;
            $name = $customer->first_name;
         
		    return view('layouts.setting.send_emailfrom',compact('route','estimates','proposal','email','name'));exit;  
		}
         
    }
}
