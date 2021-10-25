<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'display_name_singular',
        'display_name_plural',
        'icon',
        'model_name',
        'policy_name',
        
    ];

 public function permissions(){

        return $this->hasMany('App\Models\Permission');
    }

}
