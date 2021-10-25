<?php

use Illuminate\Database\Seeder;

class TaskResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resolutions')->insert([
            ['name' => 'No Resolation','icon'=>'ti-medall text-info'],
        ['name' => 'Successful','icon'=>'ti-check text-success'],
        ['name' => 'Abondoned','icon'=>'ti-id-badge text-primary'],
        ['name' => 'Left Voice Email','icon'=>'ti-receipt text-info'],
        ['name' => 'Left Message','icon'=>'ti-receipt text-info'],
    ]);
      
    }
}
