<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_item extends Model
{
    protected $table = 'menu_items';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany('App\Models\Menu_item', 'parent_id')
            ->with('children');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu_item');
    }

    
     
    public function highestOrderMenuItem($parent = null)
    {
        $order = 1;

        $item = $this->where('parent_id', '=', $parent)
            ->orderBy('order', 'DESC')
            ->first();

        if (!is_null($item)) {
            $order = intval($item->order) + 1;
        }

        return $order;
    }
}
