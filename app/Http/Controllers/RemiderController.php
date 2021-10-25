<?php

namespace App\Http\Controllers;

use App\Models\Remider;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\BaseController;

class RemiderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modul_id,$modul_member_id,$module_type=null)
    {
       
        $users = User::where('status',1)->get();
        return view('layouts.reminder.add_reminder',compact('modul_id','modul_member_id','module_type','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $request->validate([
              'description' => 'required',
               'start_date' => 'required',
              
            ]);
        $data=$request->all();
        $data['create_by']=$request->user()->id;
               
        $save = Remider::createReminder($data);
        $msg = __('msg.reminder_create_successfully');
           if(!isset($data['member_type'])){
      

            $this->createlog($save,$data['module_id'],'reminder.reminders','msg.reminder_create_successfully', $data['module_member_id']);
        }
        else{
            
            $this->createlog($save,$data['module_id'],'reminder.reminders','msg.reminder_create_successfully', $data['module_member_id'],null,$data['member_type']);
        }

        return response()->json(['status'=>'success','id'=>'reminder-tab','msg' => $msg], 200);exit;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remider  $remider
     * @return \Illuminate\Http\Response
     */
    public function show($modul_id,$modul_member_id,$module_type=null)
    {
         $url_id = $this->modulename($modul_id,$module_type);
        $remider = Remider::with('user')->where('module_id',$modul_id)->where('module_member_id',$modul_member_id)->get();

        return view('layouts.reminder.show',compact('remider','url_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remider  $remider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $reminder=Remider::findOrFail($id);
        if($request->isMethod('post')){
             $request->validate([
              'description' => 'required',
               'start_date' => 'required',
              
            ]);
            $msg = __('msg.reminder_edit_successfully');
         
                
                $data=$request->all();  
             
               
                $reminder = Remider::updateReminder($data,$id);
                 if($reminder->member_type == null){
         
                 $this->createlog($reminder,$reminder->module_id,'reminder.reminders','msg.reminder_edit_successfully', $reminder->module_member_id);
       
        }
        else{
            
              $this->createlog($reminder,$reminder->module_id,'reminder.reminders','msg.reminder_edit_successfully', $reminder->module_member_id,null,$reminder->member_type);
            
        }
                return response()->json(['status'=>'success','id'=>'reminder-tab','msg'=>$msg], 200);
          

        }else{
             $users = User::where('status',1)->get();
            return view('layouts.reminder.edit',compact('reminder','users'));exit;
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remider  $remider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remider $remider)
    {
        //
    }

    public function view($id){
          $reminder = Remider::with('user')->where('id',$id)->first();

          return view('layouts.reminder.view',compact('reminder'));exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remider  $remider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
            $reminder=Remider::findOrFail($id);
            $reminder->delete();
            
            
            $this->createlog($reminder,$reminder->module_id,'reminder.reminders',__('msg.remider_delete').' '.clean($this->user->name), $reminder->module_member_id);
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        } 
    }
}
