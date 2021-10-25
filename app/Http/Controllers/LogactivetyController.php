<?php

namespace App\Http\Controllers;

use App\Models\Resolution;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Medium;
use App\Models\Module;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;


class LogactivetyController extends BaseController
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
        $resolution = Resolution::get();
        $meduim = Medium::get();

        return view('layouts.active.add_logtouch',compact('modul_id','modul_member_id','module_type','resolution','meduim'));
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
                     'medium'   =>  'required',
                     'date'     =>  'required',
                     
                     'resolution' =>  'required',


                ]);
            try{
                $data = $request->all();
                $lead = Lead::where('id',$request->modul_member_id)->first();
                $model_title_id = $request->modul_member_id;
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
        $str .= $value. " : ";
        $str .= "<br><br>";
        $str .= __('layout.medium') . " : ". clean($request->medium);
        $str .= "&nbsp, ";
        $str .= __('layout.date') . " : ". $request->date;
        
        $str .= "<br>";
        $str .= __('layout.resolution') . " : ". clean($request->resolution);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logactivety  $logactivety
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
           $activities = Activity::with('causer')->orderBy('id', 'DESC')->get();
             return view('layouts.active.show_active',compact('activities'));exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logactivety  $logactivety
     * @return \Illuminate\Http\Response
     */
    public function edit(Logactivety $logactivety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logactivety  $logactivety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logactivety $logactivety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logactivety  $logactivety
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logactivety $logactivety)
    {
        //
    }
}
