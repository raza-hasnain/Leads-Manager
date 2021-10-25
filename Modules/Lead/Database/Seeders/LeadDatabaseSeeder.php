<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LeadDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             SeedLeadStatusesTableSeeder::class,
             SeedLeadSourcesTableSeeder::class,             
         ]);
    }
}
