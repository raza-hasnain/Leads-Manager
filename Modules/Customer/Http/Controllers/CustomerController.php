<?php

namespace Modules\Customer\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customer;
use Modules\Sales\Entities\Estimate;
use App\Models\Country;
use Modules\Customer\Http\Requests\UpdateRequest;
use Modules\Customer\Http\Requests\StoreRequest;
use Modules\Lead\Entities\LeadSource;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;
use DB;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Mail;
use Modules\Sales\Entities\Invoice;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     
     
  
    public function index(Request $request)
    {
         if(!$this->user->can('browse',app('Modules\Customer\Entities\Customer'))){
            return redirect()->route('home')->with('flash',array('status'=>'error','message'=>'permission denied'));
        } 
        $data = Customer::with('country')->get();  
        if ($request->ajax()) {          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ="";
                        $btnDel ="";
                        $btn_view ='';
                        $btn_edit ='';


                                if($this->user->can('own',app('Modules\Customer\Entities\Customer')) && $row->created_by == $this->user->id ){
                                             $btn_view ='<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i>'.__('layout.view_details').'</a></li>'; 
                                             $btn_edit ='<li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li>
                                            <li><a class="px-2 cp update-tr" id="update-tr-'.$row->id.'"><i class="fas fa-leaf pr-1"></i>'.__('layout.update_status').'</a>
                                            </li>';
                                            $btnDel = '<button class="btn btn-light delete-tr float-left" id="delete-tr-'.$row->id.'"><i class="fas fa-times"></i></button>';  
                                }
                             
                                if($this->user->can('view',app('Modules\Customer\Entities\Customer')) ){
                                             $btn_view ='<li><a class="px-2 cp view-tr" id="view-tr-'.$row->id.'"><i class="fas fa-eye pr-1"></i> '.__('layout.view_details').'</a></li>';  
                                }
                            if($this->user->can('edit',app('Modules\Customer\Entities\Customer'))){
                                          $btn_edit ='<li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li>
                                            <li><a class="px-2 cp update-tr" id="update-tr-'.$row->id.'"><i class="fas fa-leaf pr-1"></i>'.__('layout.update_status').'</a>
                                            </li>';  
                                }
                        if($this->user->can('delete',app('Modules\Customer\Entities\Customer'))){
                                         

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
                        $name = '<a class="view-tr cp" id="view-tr-'.$row->id.'">'.clean($row->name).'</a>';
                        return $name;
                    })
                    ->editColumn('status', function($row) {
                        if ($row->status == 1) {
                            $status = '<span class="text-success">'.__('layout.active').'</span>';
                        }else{
                            $status = '<span class="text-danger">'.__('layout.inactive').'</span>';
                        }
                        return $status;
                    })
                    ->rawColumns(['action','input','name','status'])
                    ->make(true); exit;
        }

        

        return view('customer::index');
    }
    public function statistics()
    {
        $data = Customer::with('country')->get(); 
        $total = $data->count();
        $statuscount = countStatus($data,'status');
        $sources = LeadSource::select(DB::raw('id, name,icon'))->withCount('customers')->get();
        return view('customer::statistics',compact('statuscount','total','sources'));
    }
    
/*show statices for dashboard*/

       public function dasboard_statistics()
        {

        $data = Customer::get(); 
        $total = $data->count();
        $statuscount = countStatus($data,'customer_source_id');
        $info =[];
        $sources = LeadSource::select(DB::raw('id, name,icon'))->withCount('customers')->get();
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
        $data['week_'.$y] = Customer::whereBetween('created_at', [$dates['week_'.$y][6].' 00:00:00',$dates['week_'.$y][0].' 23:59:59'])->where('customer_source_id',$source->id )
        
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
         
           /**
         * count customer convert form 
         */
         public function countConvertCustomer(){
            $coustomer_total = Customer::count();
            $id = LeadSource::where('name', 'Like', 'facebook')->select(DB::raw('id'))->first();
            $converted_from = Customer::whereNotNull('converted_from')->count();
            $facebooCount = Customer::where('customer_source_id',$id->id)->count();

           return response()->json(['status'=>'success', 'coustomer_total'=>$coustomer_total,  'converted_from' => $converted_from,  'facebooCount'=> $facebooCount], 200);
        exit; 
         }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(StoreRequest $request)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            try{  
                $data=$request->all();              
                $data['created_by']=$request->user()->id;
                $data['customer_id']= generateRandomStr();
                $save = Customer::createCustomer($data);
                return response()->json(['status'=>'success'], 200);exit;
            }
            catch(\Exception $e){
                return response()->json(['status'=>$e->getMessage()], 500);
            }
        }else{
            $sources = LeadSource::select(DB::raw('id, name'))->get();
            $country=Country::countriesTranslated();
            return view('customer::create',compact('country','sources'));exit;
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function view($customer_id)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('view',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        $module_id=1;
        $estimates = Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$customer_id)->get();
        $c_count= countStatus($estimates,'type');
        $Invoice = Invoice::with('status')->where('customer_id',$customer_id)->orderBy('created_at', 'DESC')->get();
        $customer=Customer::getCustomerById($customer_id);
        return view('customer::customer_details',compact('customer','estimates','c_count','Invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(UpdateRequest $request,$customer_id)
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=> $permisionmsg], 401);
			  }
        if($request->isMethod('post')){

            try{  
                $customer=Customer::findOrFail($customer_id);
                $data=$request->all();  
                $data['updated_by']=$request->user()->id;
                Customer::updateCustomer($data,$customer_id);
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{

            $customer=Customer::findOrFail($customer_id);
            $sources = LeadSource::select(DB::raw('id, name'))->get();
            $country=Country::countriesTranslated();
            return view('customer::edit',compact('customer','country','sources'));exit;
            
        }
    }


    public function statusUpdate(Request $request,$customer_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        $customer=Customer::findOrFail($customer_id);
        try{
            if ($customer->status == 1) {
                $data['status'] = 0;
                Customer::where('id', $customer_id)->update($data);
                return response()->json(['status'=>'success'], 200);exit;
            }else{
                $data['status'] = 1;
                Customer::where('id', $customer_id)->update($data);
                return response()->json(['status'=>'success'], 200);exit; 
            }
        }catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
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
		    $route = 'customer.emailsend';
		       $module_id=1;
            $estimates = Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$id)->where('type',0)->get();
            $proposal = Estimate::with('status')->where('module_id',$module_id)->where('module_member_id',$id)->where('type',1)->get();
            $Invoice = Invoice::with('status')->where('customer_id',$id)->get();
            $customer=Customer::findOrFail($id);
            $email = $customer->email;
            $name = $customer->name;
         
		    return view('layouts.setting.send_emailfrom',compact('route','estimates','Invoice','proposal','email','name'));exit;  
		}
         
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function import_file(Request $request,$file_type_id='')
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            $request->validate([
                'import_file' => 'required',
                ]);
            try{
                $files = $request->file('import_file');  
                $import = Excel::import(new CustomerImport,$files);
                return response()->json(['status'=>'success'], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   
        }else{
            $file_type = $file_type_id;
            return view('customer::import_file',compact('file_type'));exit;  
        }     
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    function deleteCustomer(Request $request,$customer_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('delete',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        try{
            $customer=Customer::findOrFail($customer_id);
            $customer->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }   
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_excel_file() 
    {
         $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
			  
       
       $excel = Excel::download(new CustomerExport, 'customers.xlsx');
      ob_end_clean();

        return $excel;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_csv_file() 
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Customer\Entities\Customer'))){
			        return response()->json(['status'=>$permisionmsg], 401);exit;
			  }
        $excel = Excel::download(new CustomerExport, 'customers.csv');
        ob_end_clean();
        return $excel;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_pdf_file() 
    {
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Customer\Entities\Customer'))){
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
        $title = "<h2 style= 'width:100%; text-align: center;'>".__('menu.Customers')."</h2>";
       
        $customers = Customer::get_customersdata();
        $pdf = PDF::loadView('customer::customers',compact('customers','title','pdf_style'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("customers.pdf");
        
    }

    public function print_file() 
    {
         $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('export',app('Modules\Customer\Entities\Customer'))){
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
        $title = "<h2 style= 'width:100%; text-align: center;'>".__('menu.Customers')."</h2>";
        $customers = Customer::get_customersdata();
        $pdf = PDF::loadView('customer::customers',compact('customers','pdf_style','title'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("customers.pdf", array("Attachment" => false));
    }
    public function download($file_type)
    {
        try {
            if ($file_type == 1) {
                $excel = Storage::download('excel/demo/customers.xlsx');
                  ob_end_clean();
        return $excel;
            }else{
                $csv = Storage::download('csv/demo/customers.csv');
                ob_end_clean();
        return $csv;
            }
            

        } catch (DecryptException $e) {
            //
            abort(404);
        }
    }
            public function viewTask($id)
    {
        
       
        return redirect()->route('task.show', [1,$id]);

    }

     public function newTask($id)
    {
        
       
        return redirect()->route('task.new', [1,$id]);

    }

    public function viewNote($id){
      return redirect()->route('note.show', [1,$id]);
    }
     public function viewActive($id){
      $activities = Activity::with('causer')->where('log_name', '1'.'_'.$id)
    ->orderBy('id', 'DESC')->get();
  

      return view('layouts.active.show',compact('activities'));
    }
    public function viewReminder($id){
      return redirect()->route('reminder.show', [1,$id]);
    }
    public function newReminder($id)
    {
        
       
        return redirect()->route('reminder.new', [1,$id]);

    }
    
    public function  sendMail($id = null){
         $msg =  __('msg.estimate_attach_successfully');
           $estimate=Estimate::with('country','estimate_items')->where('id',$id)->first();
        
         $pdf = PDF::loadView('sales::estimate.estimate_pdf',compact('estimate'));
        $pdf->setPaper('A4');
         $filename = 'estimate.pdf';
         Storage::put($filename, $pdf->output());
        return response()->json(['status'=> 'success','code'=>$estimate->estimate_number,'msg' => $msg], 200);exit;
			  
    }
    
      public function  sendMailpropsoal($id = null){
          $msg =  __('msg.proposal_attach_successfully');
           $estimate=Estimate::with('country','estimate_items')->where('id',$id)->first();
        
         $pdf = PDF::loadView('sales::proposal.propossalpdf',compact('estimate'));
        $pdf->setPaper('A4');
         $filename = 'propsoal.pdf';
         Storage::put($filename, $pdf->output());
        return response()->json(['status'=> 'success','code'=>$estimate->estimate_number,'msg' => $msg], 200);exit;
			  
    }

}
