<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedLeadSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_sources')->insert([
            ['name'     => 'Imported','icon' =>'ti-import' ],
            ['name'     => 'Facebook','icon' =>'ti-facebook text-primary ' ],
            ['name'     => 'Twitter','icon' =>'ti-twitter text-info' ],           
            ['name'     => 'Instagram','icon' =>'ti-instagram text-base' ],           
        ]);
    }
}
