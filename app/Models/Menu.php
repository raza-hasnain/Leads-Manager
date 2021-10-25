<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\Models\Menu_item');
    }

    public function parent_items()
    {
        return $this->hasMany('App\Models\Menu_item')
            ->whereNull('parent_id');
    }

  
   
    public static function display($menuName,$isSuperAdmin=false)
    {
        $menu = static::where('name', '=', $menuName)
            ->with(['parent_items.children' => function ($q) {
                $q->orderBy('order');
            }])
            ->first();        
        return $menu;
       
    }
}
