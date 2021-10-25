<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Task_status;
use App\Models\Prioritie;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use App\Models\Resolution;
use App\Models\Medium;
use DB;

class TasksController extends BaseController
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
        
        $statuses = Task_status::get();
        $priorities = Prioritie::get();
        $users = User::where('status',1)->get();
        return view('layouts.task.add',compact('modul_id','modul_member_id','module_type','statuses','priorities','users'));
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
                'title'=>'required',
               'description' => 'required',
               'start_date' => 'required',
               'deadline' => 'required'
            ]);
        $data=$request->all();
        $msg = __('msg.task_create_succesfully');
        $data['create_by']=$request->user()->id;
         $task = Tasks::createTask($data);
        if(!isset($data['member_type'])){
         $link = clean($task->title);

            $this->createlog($task,$data['module_id'],'task.task','msg.task_create_succesfully', $data['module_member_id'],$link);
        }
        else{
            $link = clean($task->title);
            $this->createlog($task,$data['module_id'],'task.task','msg.task_create_succesfully', $data['module_member_id'],$link,$data['member_type']);
        }
      


        return response()->json(['status'=>'success','id'=>'task-tab','msg'=>$msg], 200);exit;
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show($modul_id,$modul_member_id,$module_type=null)
    {
        $url_id = $this->modulename($modul_id,$module_type);
        $tasks = Tasks::with('status','priorities')->where('module_id',$modul_id)->where('module_member_id',$modul_member_id)->get();

        return view('layouts.task.show',compact('tasks','url_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
      public function show_own()
    {
        
        $tasks = Tasks::with('status','priorities')->where('assigned',$this->user->id)->get();

        return view('layouts.task.show',compact('tasks'));
    }
     
     
    public function edit(Request $request,$id)
    {
         
        $task=Tasks::findOrFail($id);
        if($request->isMethod('post')){
            $request->validate([
                'title'=>'required',
               'description' => 'required',
               'start_date' => 'required',
               'deadline' => 'required'
            ]);
            $msg = __('msg.task_edit_succesfully');
            try{  
                
                $data=$request->all();  
               
                Tasks::updateTask($data,$id);
                 if(!isset($task->member_type)){
         $link = clean($task->title);

            $this->createlog($task,$task->module_id,'task.task','msg.task_edit_succesfully', $task->module_member_id,$link);
        }
        else{
            $link = clean($task->title);
            $this->createlog($task,$task->module_id,'task.task','msg.task_edit_succesfully', $task->module_member_id,$link,$task->member_type);
        }
                return response()->json(['status'=>'success','id'=>'task-tab','msg'=>$msg], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{
            $statuses = Task_status::get();
        $priorities = Prioritie::get();
          $users = User::where('status',1)->get();
            return view('layouts.task.edit',compact('task','statuses','priorities','users'));exit;
            
        }
    }

    public function view($id){
          $task=Tasks::with('status','priorities','user')->where('id',$id)->first();

          return view('layouts.task.view',compact('task'));exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $task=Tasks::findOrFail($id);
            $task->delete();
               $this->createlog($task,$task->module_id,'Reminder.Reminder',__('msg.task_delete_by').' '.clean($this->user->name), $task->module_member_id);
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }   
    }

     public function setting(){
           $statuses = Task_status::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $sources = Prioritie::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
            $resolution = Resolution::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();
             $medium = Medium::select(DB::raw('id, name'))->orderBy('id', 'DESC')->get();

      return view('layouts.setting.task_setting',compact('statuses','sources','resolution','medium'));exit;
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
          $save = Task_status::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
         }
         else{
             $request->validate([
               'name' => 'required',
               'icon_class' => 'required',
            ]);
            
            $data['name']=$request->name;
             $data['icon']=$request->icon_class.' '.$request->color;
             $save = Task_status::createstatus($data);
         $msg = __('msg.add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
       }
                        
            
        }
        else{
            if($id==null){
                return view('layouts.setting.task_status_edit');exit;
            }
            else{
                $status = Task_status::where('id',$id)->first();
                 return view('layouts.setting.task_status_edit',compact('status'));exit;
            }
       
        
    }

        }
        public function deletestatus(Request $request,$id){
        try{
            $lead=Task_status::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }

        public function add_prioritie(Request $request,$id =null)
                {
        if($request->isMethod('post')){
            $request->validate([
               
         'name' => 'required',
            ]);
            
            $data = $request->all();
              if(isset($request->id)){
          $save = Prioritie::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
         }
         else{
             $save = Prioritie::createstatus($data);
         $msg = __('msg.create_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
       }
                        
            
        }
        else{
            
            if($id==null){
                return view('layouts.setting.prioritie_edit');exit;
            }
            else{
              
                $status = Prioritie::where('id',$id)->first();
                 return view('layouts.setting.prioritie_edit',compact('status'));exit;
            }
       
        
    }

        }
    public function deleteprioritie(Request $request,$id){
        try{
            $lead=Prioritie::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }

        public function add_resolution(Request $request,$id =null)
                {
        if($request->isMethod('post')){
            $request->validate([
               
         'name' => 'required',
            ]);
            
            $data = $request->all();
              if(isset($request->id)){
          $save = Resolution::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
         }
         else{
             $save = Resolution::createstatus($data);
         $msg = __('msg.create_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
       }
                        
            
        }
        else{
            
            if($id==null){
                return view('layouts.setting.resolation_edit');exit;
            }
            else{
              
                $status = Resolution::where('id',$id)->first();
                 return view('layouts.setting.resolation_edit',compact('status'));exit;
            }
       
        
    }

        }

        public function deleteresolution(Request $request,$id){
        try{
            $lead=Resolution::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
    public function add_medium(Request $request,$id =null)
                {
        if($request->isMethod('post')){
            $request->validate([
               
         'name' => 'required',
            ]);
            
            $data = $request->all();
              if(isset($request->id)){
          $save = Medium::updateApp($data,$request->id);

         $msg = __('msg.update_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
         }
         else{
             $save = Medium::createstatus($data);
         $msg = __('msg.create_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg,'active_id' => 'setting-1','modules' =>'task'], 200);exit;
       }
                        
            
        }
        else{
            
            if($id==null){
                return view('layouts.setting.medium_edit');exit;
            }
            else{
              
                $status = Medium::where('id',$id)->first();
                 return view('layouts.setting.medium_edit',compact('status'));exit;
            }
       
        
    }

        }
         public function deletemedium(Request $request,$id){
        try{
            $lead=Medium::findOrFail($id);
            $lead->delete();
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    } 
        
}
