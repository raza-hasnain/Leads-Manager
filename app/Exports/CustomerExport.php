<?php

namespace App\Exports;

use Modules\Customer\Entities\Customer;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class CustomerExport implements FromView
{
    public function view(): View
    {
        return view('customer::customers', [
            'customers' => Customer::select(DB::raw('name,email,country_id,phone,company,vat_number,website,address,city,state,zip_code'))->with('country')->get()
        ]);
    }
}
