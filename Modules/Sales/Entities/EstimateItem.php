<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    protected $fillable = ['estimate_id','item_id','description','long_description','quantity','unit','rate','tax_id','sub_total'];
    public function items()
    {
        return $this->belongsTo('Modules\Sales\Entities\Item');
    }
    public function estimate(){
        return $this->belongsTo('Modules\Sales\Entities\Estimate','estimate_id','id');
    }
}
