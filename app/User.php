<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token','role_id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static $admin=1;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

      public static function updateUser($requestData,$user_id){

        try{
            $user=static::find($user_id);
            $user->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }

     public function role(){

        return $this->belongsTo('\App\Models\Role');
    }

     public function isSuperAdmin(){

        return ($this->role_id==self::$admin);
    }

    public function hasPermission($name,$module_id)
    {
        $userRolesPermission= $this->UserRolesPermissionKey();
        
            return (in_array($name,$userRolesPermission)) ;


    } 
   public function  UserRolesPermissionKey(){

        $permission_array=array();
        $permissions=$this->role()->with(['permissions'=>function($query){
                    $query->pluck('key');
                }])->get()->toArray();  
        foreach ($permissions as $key => $value) {
            foreach ($value['permissions'] as $k => $v) {
                $permission_array[]=$v['key'];
            }
        }
        return $permission_array;
    }

    

    
}
