<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Country;
use Carbon\Carbon;


class BaseController extends Controller
{

    Protected $user;
    Protected $request;
    public $modules = [
                '1' => ['id' =>1,
                'name' => 'Customer'],
                '2' => [ 'id' =>2,
                'name' => 'Leads'],
                '3' => ['id' =>3,
                'name' => 'FacebookPosts'],
                '4'=> ['id' =>4,
                'name' => 'Sales','type'=>['1'=>'Invoice','2'=>'Estimate','3'=>'Proposal']],
                '5'=>['id' =>5,
                'name' => 'Settings',]];
    
    public function __construct()
    {   
        $this->middleware(function ($request, $next) {
            $this->user= Auth::User();
            $this->request=$request;
            return $next($request);
        });
               
    }

    function ajaxGetCountryCode(Request $request,$country_code){

        $country_code=Country::whereId($country_code)->value('country_code');
        echo json_encode(array('country_code'=>$country_code));
        
    }

      public function createlog($model,$model_title,$title_description,$description,$model_title_id,$route = null,$type = null){
          
        if($type == null){
           
             $value =  __('menu.'.$this->modules[$model_title]['name']);
         }
         else{
            $data = __('menu.'.$this->modules[$model_title]['type'][$type]);
            $data1 =  __('menu.'.$this->modules[$model_title]['name']);
            $value = $data1.'('.$data.')';
            $model_title = $model_title.'_'.$type;
         }
      $str = "";
        $str .= $value. " : ". $route;

        $str .= "<br><br>";
        $str .= __($title_description);
        $str .= "&nbsp, ";
        $str .= __('layout.date') . " : ". Carbon::now()->format('Y-m-d');
        $str .= "&nbsp, ";
        $str .= __('layout.time') . " : ". Carbon::now()->format('H:i');
        $str .= "<br>";
       

         $description = __($description);

        $log_name = $model_title.'_'.$model_title_id;
        log_activity($model, trim($description), $str, $log_name);


  }
  public function modulename($module_id,$module_type){
        $name = strtolower($this->modules[$module_id]['name']);
        $url = strtolower($this->modules[$module_id]['name']);
        if(isset($this->modules[$module_id]['type'])){
            $name = strtolower($this->modules[$module_id]['type'][$module_type]);
            $url = strtolower($this->modules[$module_id]['name']).'/'.strtolower($this->modules[$module_id]['type'][$module_type]);
        }

        return array($name,$url);
  }
  
     
}