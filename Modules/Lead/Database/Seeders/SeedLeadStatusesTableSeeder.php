<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedLeadStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_statuses')->insert([
            ['name' => 'New','icon'=>'ti-medall text-info'],
            ['name' => 'Contacted','icon'=>'ti-check text-success'],
            ['name' => 'Qualified','icon'=>'ti-id-badge text-primary'],
            ['name' => 'Proposal Sent','icon'=>'ti-receipt text-info'],

        ]);
    }
}
