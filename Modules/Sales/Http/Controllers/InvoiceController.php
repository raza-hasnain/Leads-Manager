<?php

namespace Modules\Sales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sales\Entities\Invoice;
use Modules\Sales\Entities\InvoiceItems;
use Modules\Sales\Entities\InvoiceStatus;
use Modules\Sales\Entities\InvoiceDetails;
use Modules\Sales\Entities\Payment;
use Modules\Customer\Entities\Customer;
use App\Models\Country;
use App\Models\Currency;
use App\User;
use Modules\Sales\Http\Requests\InvoiceUpdateRequest;
use Modules\Sales\Http\Requests\InvoiceStoreRequest;


use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PDF;
use DataTables;
use DB;
use App\Models\Module;
use App\Http\Controllers\BaseController;
use Spatie\Activitylog\Models\Activity;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
         if(!$this->user->can('browse_invoice',app('Modules\Sales\Entities\Estimate'))){
            return redirect()->route('home')->with('flash',array('status'=>'error','message'=>'permission denied'));
        }
        
       $Invoice = Invoice::with('status')->orderBy('created_at', 'DESC')->get();
        $statuses = InvoiceStatus::withCount('Invoice')->get();
        $this->status = $statuses;
       
        $total = $Invoice->count();
       
        return view('sales::invoice.index',compact('total','statuses','Invoice'));
    }
    public function statistics()
    {
        $total = Invoice::count();
     $statuses = InvoiceStatus::withCount('Invoice')->get();
        return view('sales::invoice.statistics',compact('total','statuses'));
    }
     public function create(Request $request){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('add_invoice',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        if($request->isMethod('post')){
            if($request->has('description')){
                  $request->validate([
          'invoice_number' => 'integer',
           
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

                $str = $data['invoice_number'];
                $data['url_slug'] = preg_replace('/\s+/', '-', $str);
               
                $data['created_by']= $request->user()->id;
                $estimate = Invoice::createInvoice($data);
                foreach ($data['description'] as $key => $value) {
                if (!empty($value)) {
                    $item = new InvoiceItems;
                    $item->invoice_id = $estimate;
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
            $statuses = InvoiceStatus::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
           $customer= Customer::select(DB::raw('id, name as text'))->get();
            $country=Country::countriesTranslated();
            return view('sales::invoice.create_invoice',compact('country','statuses','customer'));exit;
        }
    }

    public function getmodule($module_id)
    {
        $get_model = EstimateSource::select('module_model')->findOrFail($module_id);
        $module= $get_model->module_model;
        
        $module_name = strstr($module,'Lead\Entities\Lead');
        if ($module_name != false) {
            $get_members = $module::select('id',DB::raw("CONCAT(first_name) as text"))->get();
        }else{
            $get_members = $module::select(DB::raw('id, name as text'))->get();
        }
        $module_members=json_encode($get_members);
        return $module_members ;
    }
    public function getmodulemember($member_id)
    {
        $country = Country::get();
        
        $member = Customer::whereId($member_id)->with('country')->first();
        return view('sales::invoice.invoice_to',compact('member','country'));
    }

    public function editInvoiceStatus(Request $request,$invoice_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('edit_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        try{
            $data = $request->all();
            $invoice = Invoice::with('InvoiceDetails')->where('id',$invoice_id)->first();
         
                 Invoice::updateInvoice($data,$invoice_id);
            return response()->json(['status'=>'success'], 200);
           
        }
        catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }
    
    public function editInvoice(Request $request,$invoice_id){
        $permisionmsg =  __('layout.permission_denied');
    
        if($request->isMethod('post')){
                    
            if($request->has('description')){
                  $request->validate([
          'invoice_number' => 'integer',
           
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
              
                Invoice::updateInvoice($data,$invoice_id);
                InvoiceItems::where('invoice_id',$invoice_id)->delete();
                foreach ($data['description'] as $key => $value) {
                if (!empty($value)) {
                   $item = new InvoiceItems;
                    $item->invoice_id = $invoice_id;
                    $item->description = $value;
                    $item->item_id = $data['item_id'][$key];
                    $item->long_description = $data['long_description'][$key];
                    $item->quantity = $data['quantity'][$key];
                    $item->rate = $data['rate'][$key];
                    $item->sub_total = $data['sub_total'][$key];
                    $item->save();;
                }
            }
                return response()->json(['status'=>'success'], 200);
          
        }else{
            $country = Country::get();
            $statuses = InvoiceStatus::get();
            $estimate = Invoice::with('invoice_items','customer')->whereId($invoice_id)->first();
            if(in_array($estimate->status_id, array('1','3','4','5'))){
                
                return response()->json(['status'=> 'fail','msg' => __('invoice.not_editable').' '.$estimate->status->name ], 401);exit;
            }
         
            return view('sales::invoice.edit',compact('statuses','country','estimate'));
        }
    }



    public function viewInvoice($invoice_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('view_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        $statuses = InvoiceStatus::get();
        $invoice= Invoice::getinvoiceById($invoice_id);
         $pay = InvoiceDetails::where('invoice_id',$invoice_id)->orderBy('id', 'desc')->first();
        return view('sales::invoice.show_invoice',compact('invoice','statuses','pay')) ;
    }  
    
    public function viewPayment($id)
    {
        $InvoiceDetails = Invoice::with('InvoiceDetails.payment')->where('id',$id)->first();
        $statuses = InvoiceStatus::get();
        $show = 0;
         $value = $InvoiceDetails->InvoiceDetails->last();
       if(!$InvoiceDetails->InvoiceDetails->isEmpty() && $value->due == "0.00"){
          $show = 1;
        }
        return view('sales::invoice.show_payment',compact('InvoiceDetails','statuses','show')) ;

    }
    public function addPayment(Request $request,$id){
        $invoice = Invoice::with('InvoiceDetails.payment')->where('id',$id)->first();
        $paymenttype = Payment::get();

        $due = $invoice->total;
        if($invoice->InvoiceDetails->count() > 0){
            $amount = $invoice->InvoiceDetails->last();
            $due = $amount->due;
        }
        
        $user = User::select('id','name')->where('status',1)->get();
         if($request->isMethod('post')){
             
           
            $request->validate([
         
         'amount' => 'required|numeric|between:1,'.(int)$due.'',
         'payment_id' => 'required',
         
      ]);
           
             if(!$invoice->InvoiceDetails->isEmpty()){
              $value = $invoice->InvoiceDetails->last();
              $due = $value->due;
            }
            else{
               $due = $invoice->total;
            }
            
              $data=$request->all(); 
                $data['refernce_number']= $invoice->invoice_number.'-'.generateRandomStr();
                 $data['invoice_id'] = $id;
                 $data['due'] = $due - $data['amount'];
                 $msg = $data['refernce_number'].__('msg.add_successfully');
                   $save = InvoiceDetails::created_Invoicedetails($data);
                   if($data['due'] == 0.00){
                       $data1['status_id'] = 1;
                        Invoice::updateInvoice($data1,$id);
                   }
                   else{
                      $data1['status_id'] = 3;
                        Invoice::updateInvoice($data1,$id); 
                   }
                return response()->json(['status'=>'success','msg' =>$msg], 200);exit; 

       

        }
        else{
       

        return view('sales::invoice.add_payment',compact('invoice','paymenttype','user'));
    }


    }

     public function viewTask($id)
    {
        
       
        return redirect()->route('task.show', [4,$id,1]);

    }

     public function newTask($id)
    {
        
       
        return redirect()->route('task.new', [4,$id,1]);

    }

    public function viewNote($id){
      return redirect()->route('note.show', [4,$id,1]);
    }
     public function viewActive($id){
      $activities = Activity::with('causer')->where('log_name', '4_1_'.$id)
    ->orderBy('id', 'DESC')->get();
  

      return view('layouts.active.show',compact('activities'));
    }
    public function viewReminder($id){
      return redirect()->route('reminder.show', [4,$id,1]);
    }
    public function newReminder($id)
    {
        
       
        return redirect()->route('reminder.new', [4,$id,1]);

    }
    public function deleteInvoice(Request $request,$estimate_id){
        $permisionmsg =  __('layout.permission_denied');
        if(!$this->user->can('delete_estimates',app('Modules\Sales\Entities\Estimate'))){
			        return response()->json(['status'=> $permisionmsg], 401);exit;
			  }
        try{
            $estimate=Invoice::findOrFail($estimate_id);
            $estimate_items=InvoiceItems::where('invoice_id',$estimate_id)->get();
            foreach ($estimate_items as $item) {
                $item->delete();
            }
            $estimate->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
  
     /**
         * count lead convert form 
         */
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
          $save = InvoiceStatus::updateApp($data,$request->id);

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
             $save = InvoiceStatus::createstatus($data);
         $msg = __('msg.add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
       }
                        
            
        }
        else{
            if($id==null){
                return view('sales::setting.edit_invoiceStatus');exit;
            }
            else{
                $status = InvoiceStatus::where('id',$id)->first();
                 return view('sales::setting.edit_invoiceStatus',compact('status'));exit;
            }
       
        
    }

        }
         

        
              public function add_source(Request $request,$id =null)
                {
        if($request->isMethod('post')){
            $request->validate([
			   'type' => 'required',
         'title' => 'required',
			]);
            
            $data = $request->all();
              if(isset($request->id)){
          $save = Payment::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
         }
         else{
             $save = Payment::createstatus($data);
         $msg = __('msg.create_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'sales'], 200);exit;
       }
                        
            
        }
        else{
            
            if($id==null){
                return view('sales::setting.edit_paymentsource');exit;
            }
            else{
              
                $status = Payment::where('id',$id)->first();
                 return view('sales::setting.edit_paymentsource',compact('status'));exit;
            }
       
        
    }

        }
        
           public function deletestatus(Request $request,$id){
        try{
            $lead=InvoiceStatus::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    
        public function deletesource(Request $request,$id){
        try{
            $lead=Payment::findOrFail($id);
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

     public function showPayment($id){
          $payment = InvoiceDetails::with('invoice','payment','user')->where('id',$id)->first();

          return view('sales::invoice.paymentview',compact('payment'));exit;
    }
        public function dasboard_statistics()
        {

        $data = Invoice::get(); 
        $total = $data->count();
        $statuscount = countStatus($data,'status_id');
        $info =[];
        $sources = InvoiceStatus::select(DB::raw('id, name,icon'))->withCount('Invoice')->get();
       
     foreach ($sources as $source) {
          if(array_key_exists($source->id,$statuscount)){
            $info[$source->name] = $statuscount[$source->id];
          }
        }
      
        return response()->json(['status'=>'success', 'data'=>$info,'total'=> $total], 200);
        exit;
         }
         
    public function export_pdf_file($invoice_id) 
    {
        $permisionmsg =  __('layout.permission_denied');
        
	  $invoice=Invoice::with('customer')->where('id',$invoice_id)->first();
	  $pay = InvoiceDetails::where('invoice_id',$invoice_id)->orderBy('id', 'desc')->first();
	  $pdf_style = 'style=background:#fff;';
        $pdf = PDF::loadView('sales::invoice.invoice_pdf',compact('invoice','pay','pdf_style'));
        $pdf->setPaper('A4');
        return $pdf->stream("invoice.pdf");
        
    }
    
     public function  sendMail($id = null){
          $msg =  __('msg.inovoice_attach_successfully');
           $invoice=Invoice::with('customer')->where('id',$id)->first();
           $pdf_style = 'style=background:#fff;';
        $pay = InvoiceDetails::where('invoice_id',$id)->orderBy('id', 'desc')->first();
         $pdf = PDF::loadView('sales::invoice.invoice_pdf',compact('invoice','pay','pdf_style'));
        $pdf->setPaper('A4');
         $filename = 'invoice.pdf';
         Storage::put($filename, $pdf->output());
        return response()->json(['status'=> 'success','msg' => $msg], 200);exit;
			  
    }

    public function print_file($invoice_id) 
    {
     $permisionmsg =  __('layout.permission_denied');
      $pdf_style = 'style=background:#fff;';
        
	  $invoice=Invoice::with('customer')->where('id',$invoice_id)->first();
        
         $pdf = PDF::loadView('sales::invoice.invoice_pdf',compact('invoice','pdf_style'));
        
        return $pdf->stream("invoice.pdf", array("Attachment" => false));
    }
}
