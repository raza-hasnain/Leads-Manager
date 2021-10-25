<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Module;

class BasicPolicy
{
    use HandlesAuthorization;

    protected static $datatypes = [];

    /**
     * Handle all requested permission checks.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return bool
     */
    public function __call($name, $arguments)
    {   
        if (count($arguments) < 2) {
            throw new \InvalidArgumentException('not enough arguments');
        }
        $user = $arguments[0];
        $model = $arguments[1];
  if($user->isSuperAdmin()){
            return true;
        }
       
        return $this->checkPermission($user, $model, $name);
    }

    
    protected function checkPermission(User $user, $model, $action)
    {
        
        if($model instanceof \Illuminate\Database\Eloquent\Model && is_object( $model)){

            if (!isset(self::$datatypes[get_class($model)])) {
                $dataType = new module();
                self::$datatypes[get_class($model)] = $dataType->where('model_name', get_class($model))->first();
            }
            
            $dataType = self::$datatypes[get_class($model)];   
            return $user->hasPermission($action.'_'.$dataType->name,$dataType->id);
        }

        return $user->hasPermission($action.'_'.$model,$dataType->id);
        
    }
}
