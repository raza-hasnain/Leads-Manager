<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Modules\Customer\Entities\Customer;
use App\companySetting;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

/*For uploading image  */
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        
        return view('home');
    }

    public function profileSetting(Request $request){
        if($request->isMethod('post')){
           
            try{ 
   
               
                $data=$request->all();
                if($data['password'] !=null){
              $data['password'] = Hash::make($data['password']);
                }
                else{
                    unset($data['password']);
                }
                User::updateUser($data,Auth::user()->id);
                return response()->json(['status'=> 'success'], 200);

            }catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }   
        }else{
            
                $user = User::find(Auth::user()->id);

            
                return view('layouts.setting.profileSetting',compact('user'));exit;

        }
    }
    public function media(){

        $pics = Media::allPic();
        
        return view('layouts.admin.media',compact('pics'));
    }
}
