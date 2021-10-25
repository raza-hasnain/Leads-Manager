<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class NoteController extends BaseController
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
    public function create()
    {
        //
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
              
            ]);
          $data=$request->all();
          
        $data['create_by']=$request->user()->id;
            
        $save = Note::createNote($data);
       
        return response()->json(['status'=>'success'], 200);exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($modul_id,$modul_member_id,$module_type=null)
    {
        $notes = Note::with('user')->where('module_id',$modul_id)->where('module_member_id',$modul_member_id)->get();
        return view('layouts.note.show',compact('notes','modul_id','modul_member_id','module_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request,$id)
    {
        $note=Note::findOrFail($id);
        if($request->isMethod('post')){
             $request->validate([
               
               'description' => 'required',
              
            ]);
            
            $msg = __('msg.update_successfully');
            try{  
                
                $data=$request->all();  
               $data['create_by']=$request->user()->id;
                Note::updateNote($data,$id);
         
                return response()->json(['status'=>'success','id'=>'note-tab','msg'=>$msg], 200);
            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   

        }else{
           
            return view('layouts.note.edit',compact('note'));exit;
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
            $task=Note::findOrFail($id);
            $task->delete();
            $this->createlog($task,$task->module_id,'reminder.note',__('msg.note_delete_by').' '.clean($this->user->name), $task->module_member_id);
            return response()->json(['status'=>'success'], 200);

        }catch(\Exception $e){
            return response()->json(['status'=>'error'], 500);
        }
    }
}
