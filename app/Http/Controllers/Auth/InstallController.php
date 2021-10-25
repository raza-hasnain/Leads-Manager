<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InstallController extends Controller
{
  


 

    public function index(){
      
       
       
         if($_ENV['APP_VERFY'] != 'success')
           {
          
        $this->sqlite();
        return $this->migrate();
        }
       
  
    else{
        return view('auth.installer_remove');
    }
    }

    function remove_installer(){
        if($this->remove_installer_now()){

            return view('auth.launch_application');
            
        }else{
             $path = base_path().'/install';
            if (File::exists($path)) {
                
                return view('auth.installer_remove');
                
            }else{
                
               return redirect()->route('login');
            }
            
        }
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
       return redirect()->route('installer.remove');
        
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

        function remove_installer_now(){
            $path = base_path().'/install';
            if (File::exists($path)){
            File::cleanDirectory($path);
            $value = rmdir( $path );
            return $value;
        }
        else{
            return false;
        }
        }

      public function get_core_data(){
        $path = base_path().'/vendor/laravel/framework/Lic.html';
        if (file_exists($path)) {

            $respo = file_get_contents($path);

            echo $respo;

        }else{

            $err['msg'] = "error";
            echo json_encode($err);
        }
    }

}
