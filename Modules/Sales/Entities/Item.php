<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    protected $fillable = ['item_id','item_category_id', 'name', 'description','rate','created_at','updated_at','unit','tax_id_1','created_by','tax_id_2'
    ];

    public function item_category(){
        return $this->belongsTo('Modules\Sales\Entities\ItemCategory','item_category_id','id');
    }

    public static function get_items(){
        $items=static::select(DB::raw('name,description,item_category_id,rate,unit,tax_id_1,tax_id_2,created_by'))->with('item_category')->get();
        return $items;
    }

    public static function createItem($requestData){
        try{
        	static::create($requestData);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function updateItem($requestData,$item_id){

        try{
            $item=static::find($item_id);
            $item->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
