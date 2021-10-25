<?php

namespace App\Exports;

use Modules\Lead\Entities\Lead;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LeadExport implements FromView
{
     
    

    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    public function view(): View
    {
        return view('lead::leads', [
            'leads' => Lead::select(DB::raw('first_name,last_name,email,country_id,phone,social_id_link,company,position,website,address,city,state,zip_code,lead_status_id,lead_source_id,assigned_to'))->with('country','status','source','assigned')->get()
        ]);
    }
}
