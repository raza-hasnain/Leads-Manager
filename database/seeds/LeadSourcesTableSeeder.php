<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeadSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_sources')->insert([
            ['name'     => 'Imported','icon' =>'ti-import','status' => null ],
            ['name'     => 'Facebook','icon' =>'ti-facebook text-primary ','status' => 1 ],
            ['name'     => 'Twitter','icon' =>'ti-twitter text-info','status' => null ],           
            ['name'     => 'Instagram','icon' =>'ti-instagram text-base','status' => null ],           
        ]);
    }
}
