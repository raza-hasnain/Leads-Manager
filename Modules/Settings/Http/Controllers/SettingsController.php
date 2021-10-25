<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Requests\StoreRequest;
use Modules\Settings\Entities\Pusher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Timezone;
use Config;
use App\companySetting;
use App\Models\Module;
use App\Models\Role;
use DB;
use App\Models\Emailsetting;

//for language
use JoeDixon\Translation\Http\Requests\LanguageRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JoeDixon\Translation\Drivers\Translation;
use JoeDixon\Translation\Http\Requests\TranslationRequest;
use JoeDixon\Translation\Language;
use App\User;
use App\Models\Country;
use DataTables;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
private $translation;
   public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }
    public function index()
    {
        
        return view('settings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function pusher_settings(Request $request)
    {

        if($request->isMethod('post')){
               $request->validate([
			   'pusher_app_key' => 'required',
			   'pusher_app_secret' => 'required',
			   'pusher_app_cluster' => 'required',
			   'pusher_app_id' => 'required',
			]);
            $data=$request->all(); 
              if(isset($request->id)){
          $save = Pusher::updateApp($data,$request->id);

         
         }
         else{
          
             $save = Pusher::createPusher($data);
              
         
       }
          $data_fb['PUSHER_APP_ID'] =  removeWhite($data['pusher_app_key']);
        $data_fb['PUSHER_APP_KEY'] = removeWhite($data['pusher_app_secret']);
        $data_fb['PUSHER_APP_SECRET'] = removeWhite($data['pusher_app_id']);
         $data_fb['PUSHER_APP_CLUSTER'] = removeWhite($data['pusher_app_cluster']);
       $result = changeEnv($data_fb);
         $msg = __('msg.pusher_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;               
            
        }
        $data = Pusher::first();
        return view('settings::layouts.pusher_setting',compact('data'));exit;
    }

    /*add user*/
    public function adduser(Request $request)
    {
         if($request->isMethod('post')){
              $request->validate([
			   'name' => 'required',
			   'password' => 'required',
			   'email' => 'required|email|unique:users',
			   'role_id' => 'required',
			]);
            $data=$request->all(); 
            $data['password'] = Hash::make($data['password']);
            $data['status'] =1;
              User::create($data);
         $msg = __('msg.user_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;               
            
        }
        $roles = Role::where('id', '<>', 1)->get();
        
        return view('settings::layouts.add_user',compact('roles'));exit;

    }

       /*edit user*/
    public function edituser(Request $request,$id)
    {
         if($request->isMethod('post')){
              $request->validate([
			   'name' => 'required',
			   'email' => 'required|email',
			   'role_id' => 'required',
			]);
            $data=$request->all(); 
            
              User::updateUser($data,$id);
         $msg = __('msg.user_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;               
            
        }
        $roles = Role::where('id', '<>', 1)->get();
        $user = User::findOrFail($id);
        return view('settings::layouts.edit_user',compact('roles','user'));exit;

    }
    /*Update User Status*/
    public function statusUpdate(Request $request,$user_id){
        $user = User::findOrFail($user_id);
        try{
            if ($user->status == 1) {
                $data['status'] = 0;
                User::where('id', $user_id)->update($data);
                return response()->json(['status'=>'success'], 200);exit;
            }else{
                $data['status'] = 1;
                User::where('id', $user_id)->update($data);
                return response()->json(['status'=>'success'], 200);exit; 
            }
        }catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }
    
       /*delete User fromlis*/
    public function deleteUpdate(Request $request,$user_id){
        $user = User::findOrFail($user_id);
        try{
           
                $data['status'] = 3;
                User::where('id', $user_id)->update($data);
                return response()->json(['status'=>'success'], 200);exit;
            
        }catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
    }
    /*User List*/
    function userlist(Request $request){
        $users = User::with('role')->where('status','!=',3)->get();
        if ($request->ajax()) {          
            return Datatables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ="";
                        $btnDel ="";

                                               
                                if($row->role_id !=1){
                                   $btn = '<div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            
                                            <li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i>'.__('layout.edit_details').'</a></li>
                                            <li><a class="px-2 cp update-tr" id="update-tr-'.$row->id.'"><i class="fas fa-leaf pr-1"></i>'.__('layout.update_status').'</a>
                                            </li>
                                        </ul>
                                </div>';         
                           $btnDel = '<button class="btn btn-light delete-tr float-left" id="delete-tr-'.$row->id.'"><i class="fas fa-times"></i></button>';
                            return $btn.$btnDel;
                        }
                        else{
                            $btnDel =__('layout.admin');

                        }
                        
                            
                    })
                  
                    ->editColumn('name', function($row) {
                        $name = '<a class="view-tr cp" id="view-tr-'.$row->id.'">'.clean($row->name).'</a>';
                        return $name;
                    })
                    ->editColumn('status', function($row) {
                        if ($row->status == 1) {
                            $status = '<span class="text-success">'.__('layout.active').'</span>';
                        }else{
                            $status = '<span class="text-danger">'.__('layout.Deactive').'</span>';
                        }
                        return $status;
                    })
                    ->editColumn('role.name',function($row){
                        if($row->role->id == 1){
                            $role = __('layout.owner');
                        }
                        else{
                            $role = clean($row->role->name);
                        }
                        return $role;
                    })
                    ->rawColumns(['action','name','status'])
                    ->make(true); exit;
                }
        
    }
    public function showuserlist(){
        return view('settings::layouts.user_list');exit;
    }

     public function profileSetting(Request $request){
        if($request->isMethod('post')){
           
           $request->validate([
			   'name' => 'required|string',
			   'address' => 'required',
			   'country_id' => 'required',
			   'phone_no' => 'required|numeric',
			  
			 
			   'footer_container' => 'required|string',
			   
			]);
			$data=$request->all();
			if($request->has('image')&& $request->image !=null){
			   
        $logo = img_process($request->image,'app/public/logo');
        $data['logo']= 'storage/logo/'.$logo[0].'.'.$logo[1];
			}
		if($request->has('image_sm')&& $request->image_sm !=null){
        $logo_sm = img_process($request->image_sm,'app/public/logo');
        $data['logo_sm']= 'storage/logo/'.$logo_sm[0].'.'.$logo_sm[1];
		}
		if($request->has('image_favicon')&& $request->image_favicon !=null){
        $icons = img_process($request->image_favicon,'app/public/logo');
        $data['icons']= 'storage/logo/'.$icons[0].'.'.$icons[1];
		}
		if($request->has('image_background')&& $request->image_background !=null){
      
        $icons = backgrountprocess($request->image_background,'app/public/logo','profile-bg');
        
    }
            
    
          
                $data['updated_by']=$request->user()->id;
               

                companySetting::updateOrganization($data);
                $msg = __('msg.application_add_successfully');
                return response()->json(['status'=> 'success','msg' => $msg], 200);

             
       }
        else{
            
                $organization = companySetting::first();
             $country=Country::countriesTranslated();
                return view('settings::layouts.appsetting',compact('country','organization'));exit;

        }
    }

    public function language(){
      $languages = Language::get();
   
        return view('settings::layouts.add_lang', compact('languages'));
    }
    public function addlanguage(Request $request){
     
      if($request->isMethod('post')){
          $request->validate([
			   
			   'name' => 'required',
			   'language' => 'required|unique:languages|not_regex:/(\s*)<script(?![ \t\r\n]+type\s*=\s*"\s*text\/x\-template\s*").*?(\b[^>]*?>)([\s\S]*?)<\/script>(\s*)/',
			  
			   
			]);
            $data=$request->all();
            $language = Language::createLanguge($data); 
             $this->translation->addLanguage($data['language'], $data['name']);
            
         $msg = __('msg.language_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;               
            
        }
        
        return view('settings::layouts.add_lang_modal');exit;
    }
    
    public function addlanguageactive($id){
            $data_fb['APP_LANG'] =  $id;
      
       $result = changeEnv($data_fb);
        $msg = __('msg.language_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;
        
    }
    public function translation(Request $request, $language){
      
        if ($request->has('language') && $request->get('language') !== $language) {
            return redirect()
                ->route('settins.translation', ['language' => $request->get('language'), 'group' => $request->get('group'), 'filter' => $request->get('filter')]);
        }

        $languages = $this->translation->allLanguages();
        $groups = $this->translation->getGroupsFor(config('app.locale'))->merge('single');
        $translations = $this->translation->filterTranslationsFor($language, $request->get('filter'));

        if ($request->has('group') && $request->group) {
            if ($request->group === 'single') {
                $translations = $translations->get('single');
                $translations = new Collection(['single' => $translations]);
            } else {
                $translations = $translations->get('group')->filter(function ($values, $group) use ($request) {
                    return $group === $request->group;
                });

                $translations = new Collection(['group' => $translations]);
            }
        }
        
         return view('settings::layouts.tansation_lang', compact('language', 'languages', 'groups', 'translations'));exit;
    }
    public function translationadd(Request $request)
    {
      $language = config('app.locale');

      if($request->isMethod('post')){
            $data=$request->all(); 
            if ($request->group != null ) {
          
            $this->translation->addGroupTranslation($language, "{$request->group}", $request->key, $request->value ?: '');
        } else {
            $this->translation->addSingleTranslation($language, 'single', $request->key, $request->value ?: '');
        }
        $msg = __('msg.translation_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;            
            
        }
        else{
          $groups = $this->translation->getGroupsFor($language);
          return view('settings::layouts.add_tansation_modal',compact('groups'));exit;
        }


    }

    public function translationupdate(Request $request, $language)
    {
        if (! Str::contains($request->group, 'single')) {
            $this->translation->addGroupTranslation($language, $request->get('group'), $request->get('key'), $request->get('value') ?: '');
        } else {
            $this->translation->addSingleTranslation($language, $request->group, $request->key, $request->value ?: '');
        }
        $msg = __('msg.translation_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;
    }

    /*country list*/

     public function countryshowlist(){
        return view('settings::layouts.countrylist_show');exit;
    }
        function countrylist(Request $request){
        $countries=Country::get();
        
        if ($request->ajax()) {          
            return Datatables::of($countries)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ="";
                    

                                               
                                if($row->role_id ==0){
                                    $btn = '<div class="dropdown float-left">
                                    <button type="button" class="btn btn-light dropdown-toggle " data-toggle="dropdown"><i class="fas fa-cog"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            
                                            <li><a class="px-2 cp edit-tr" id="edit-tr-'.$row->id.'"><i class="fas fa-edit pr-1"></i> '.__('layout.edit_details').'</a></li>
                                           
                                        </ul>
                                </div>'; 
                            
                        }
                        else{
                          $btn ="";
                        
                            
                        }
                        
                            return $btn;
                    })->editColumn('name',function($row){
                        return clean($row->name);
                    })->editColumn('iso',function($row){
                        return clean($row->iso);
                    })
                  
                   
                    ->rawColumns(['action'])
                    ->make(true); exit;
                }
        
            }

            public function addcountrylist(Request $request,$id=null)
            {

      if($request->isMethod('post')){
          
           $request->validate([
			   'name' => 'required',
			   'iso' => 'required|min:1|max:4',
			   'country_code' => 'required|numeric',
			  
			   
			]);
            $data=$request->all();
            if($request->has('id')){
              $country = country::updateCountry($data,$request->id);
            
          }
          else{
              
            $country = country::createCountry($data);
          }
            
            
         $msg = __('msg.country_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;               
            
        }
        if($id ==null){
        return view('settings::layouts.country_modal');exit;
      }
      else{
        $country = country::findOrFail($id);

        return view('settings::layouts.country_modal',compact('country'));exit;
      }

            }
    public function timezone(Request $request){

       if($request->isMethod('post')){
         
  
             $data_fb['APP_TIMEZONE'] =  $request->timezone;
      
       $result = changeEnv($data_fb);
            $msg = __('msg.timezone_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          $selected = config('app.timezone');
$placeholder = 'Select a timezone';
$formAttributes = array('class' => 'col-lg-12 form-control  m-input--solid', 'name' => 'timezone');
  $optionAttributes = array('customValue' => 'true');

$select = Timezone::selectForm($selected, $placeholder, $formAttributes, $optionAttributes);

           return view('settings::layouts.select_timezone',compact('select'));exit;

    }
    public function emailsetting(Request $request){

       if($request->isMethod('post')){
             $request->validate([
			   'driver' => 'required',
			   'host' => 'required',
			   'port' => 'required',
			    'encryption' => 'required',
			   'form_address' => 'required',
			   'form_name' => 'required',
			   'username' => 'required',
			   'password' => 'required',
			]);
              $data = $request->all();
              $data_mail['MAIL_DRIVER'] = removeWhite($request->driver);
              $data_mail['MAIL_HOST'] = removeWhite($request->host);
              $data_mail['MAIL_PORT'] = removeWhite($request->port);
              $data_mail['MAIL_FROM_ADDRESS'] = removeWhite($request->form_address);
              $data_mail['MAIL_FROM_NAME'] = removeWhite($request->form_name);
              $data_mail['MAIL_ENCRYPTION'] = removeWhite($request->encryption);
              $data_mail['MAIL_USERNAME'] = removeWhite($request->username);
              $data_mail['MAIL_PASSWORD'] = removeWhite($request->password);
              
              if(isset($request->id)){
          $email = Emailsetting::updateEmail($data,$request->id);
        
         
         }
         else{
          $email=Emailsetting::createemail($data);
         }
         
         $result = changeEnv($data_mail);
            $msg = __('msg.email_add_successfully'); 
         
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          $email = Emailsetting::first();
          
           return view('settings::layouts.email_setting',compact('email'));exit;

    }

    public function roleConfig(Request $request){

       if($request->isMethod('post')){
            $data = $request->all();
            $role_id= $request->role_id;
            
            $role=Role::findOrFail($role_id);
             
            DB::beginTransaction();
            $permissions=(isset($request['permission_id']))?$request['permission_id']:array();
            $role->permissions()->sync($permissions);
            $role->permissions()->detach();
            if($permissions){
                $role->permissions()->attach($permissions);
            }
            $modules=(isset($request['module_id']))?$request['module_id']:array();
            $role->modules()->sync($modules);
            $role->modules()->detach();
            if($permissions){
                $role->modules()->attach($modules);
            }
            DB::commit();
            $msg = __('msg.role_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          $modulesName = Module::with('permissions')->get();
          $roles = Role::where('id', '<>', 1)->get();

           return view('settings::layouts.role_config',compact('modulesName','roles'));exit;

    }
    public function roleadd(Request $request){

       if($request->isMethod('post')){
            $request->validate([
                'name' => 'required'
                ]);
          $data=$request->all();
          $data['create_by'] = $request->user()->id;
          $role = Role::createRole($data);
            $msg = __('msg.role_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          

           return view('settings::layouts.add_role_modal');exit;

    }
      public function roleList(){
        $roles = Role::where('id', '<>', 1)->get();
         return view('settings::layouts.role_list',compact('roles'));exit;
      }
      public function deleteRole(Request $request,$id){
            try{
           
                DB::table('module_role')->where('role_id', $id)->delete();
                DB::table('permission_role')->where('role_id', $id)->delete();
                $role=Role::findOrFail($id);
            $role->delete();
            return response()->json(['status'=>'success'], 200);
            
        }catch(\Exception $e){
            return response()->json(['status'=>$e->getMessage()], 500);
        }
          
      }
      

    public function roleAssign(Request $request){
        if($request->isMethod('post')){
        
            $msg = __('msg.role_add_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          $users = User::where('role_id','!=',  0)->where('status',1)->get();
          $roles = Role::where('id', '<>', 1)->get();

           return view('settings::layouts.role_assign',compact('users','roles'));exit;
    }

    public function roleEdit(Request $request,$id){

       if($request->isMethod('post')){
            $data = $request->all();
            $role_id= $request->role_id;
            
            $role=Role::findOrFail($role_id);
             
            DB::beginTransaction();
            $permissions=(isset($request['permission_id']))?$request['permission_id']:array();
            $role->permissions()->sync($permissions);
            $role->permissions()->detach();
            if($permissions){
                $role->permissions()->attach($permissions);
            }
            $modules=(isset($request['module_id']))?$request['module_id']:array();
            $role->modules()->sync($modules);
            $role->modules()->detach();
            if($permissions){
                $role->modules()->attach($modules);
            }
            DB::commit();
            $msg = __('msg.role_edit_successfully'); 
         return response()->json(['status'=>'success','msg' => $msg], 200);exit;  
            
          }
          $modulesName = Module::with('permissions')->get();
          $roles = Role::with('permissions','modules')->where('id',$id)->first();
          $permissions = $roles->permissions->map(function($item,$key){
                        $permission=$item->pivot->permission_id;
                            return $permission;
                    })->toArray();
          $modules = $roles->modules->map(function($item,$key){
                        $permission=$item->pivot->module_id;
                            return $permission;
                    })->toArray();

         
         
            
           return view('settings::layouts.role_config_edit',compact('modulesName','permissions','modules','roles'));exit;

    }
    
       public function modulesetting(){
    

      $modulesName = Module::where('settingable',1)->get();
      return view('settings::layouts.module_setting',compact('modulesName'));exit;
    }
}
