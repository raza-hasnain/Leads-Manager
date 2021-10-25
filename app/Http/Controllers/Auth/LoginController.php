<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Modules\FacebookPost\Entities\AppSetting;
use Illuminate\Support\Facades\Session;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /*api */
    Protected $api;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      if($_ENV['APP_VERFY'] != 'success')
           {
            Auth::logout();
            Session::flush();
              }

        $this->middleware('guest')->except('logout');
    }

   protected function credentials(Request $request)
    {        
   return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }

    public function index(){
      
       
       
         if($_ENV['APP_VERFY'] != 'success')
           {
          
        $this->sqlite();
        return $this->migrate();
        }
         else if(\Auth::check()){
            return redirect()->route('home');
        }
  
    else{
        return view('auth.login');
    }
    }

    public function redirectToFacebookProvider()
    {
        $scopes = explode(",",$_ENV['FACEBOOK_SCOPES']);
        return Socialite::driver('facebook')->scopes($scopes)->redirect();
    }
 
    /**
     * Obtain the user information from Facebook.
     *
     * @return void
     */
    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user();

        $user = User::updateOrCreate(
            [
                'email' => Cache::get('users'),
            ],
            [
                'token' => $auth_user->token,
                'name'  =>  $auth_user->name
            ]
        );
 
        Auth::login($user, true);
        return redirect()->to('/'); // Redirect to a secure page
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }
    public function customer_invite(){

        $country=Country::countriesTranslated();
        return view('customer_invite',compact('country'));
    }
     public function lead_invite(){

        $country=Country::countriesTranslated();
        return view('lead_invite',compact('country'));
    }

    public function migrateAndSeed()
    {
        
        $this->sqlite();
        return $this->migrate();
    
   
    }

    /**
     * Run the migration and call the seeder.
     *
     * @return array
     */
    private function migrate()
    {
        try{
            Artisan::call('migrate', ["--force"=> true ]);
        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }

        return $this->seed();
    }

    /**
     * Seed the database.
     *
     * @return array
     */
    private function seed()
    {
        try{
            Artisan::call('db:seed');
          
        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }
        return $this->soymlink();
     
    }

    public function soymlink(){
        try{
            Artisan::call('storage:link');
          
        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }
         return $this->response(trans('installer_messages.final.finished'), 'success');
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param string $status
     * @return array
     */
    private function response($message, $status = 'danger')
    {
        if($status == 'danger'){
        return array(
            'status' => $status,
            'message' => $message
        );
        }
        $data_fb['APP_ENV'] =  'production';
        $data_fb['APP_DEBUG'] = 'false';
        $data_fb['APP_VERFY'] = 'success';
         
       $result = changeEnv($data_fb);
       Auth::logout();
       return redirect()->route('login');
        
    }
    
        /**
     * check database type. If SQLite, then create the database file.
     */
    private function sqlite()
    {
        if(DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();
            if(!file_exists($database)) {
                touch($database);
                DB::reconnect(Config::get('database.default'));
            }
        }
        }
}
