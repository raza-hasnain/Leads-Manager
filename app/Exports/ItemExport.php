<?php

namespace App\Exports;

use Modules\Sales\Entities\Item;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ItemExport implements FromView
{
    public function view(): View
    {
        return view('sales::item.items', [
            'items' => Item::select(DB::raw('name,description,item_category_id,rate,unit,tax_id_1,tax_id_2,created_by'))->with('item_category')->get()
        ]);
    }
}
