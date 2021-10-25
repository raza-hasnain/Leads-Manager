<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = ['name','parent_id'];

    public function parent_category(){
        return $this->belongsTo('Modules\Sales\Entities\ItemCategory','parent_id','id');
    }
    public static function createItemCategory($requestData){
        try{
        	static::create($requestData);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 1);
        }
    }
    public static function updateItemCategory($requestData,$item_id){

        try{
            $item=static::find($item_id);
            $item->fill($requestData)->save();
        }catch(\Exception $e){   
            throw new \Exception($e->getMessage(), 1);           
        }
    }
}
