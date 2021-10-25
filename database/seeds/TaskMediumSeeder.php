<?php

use Illuminate\Database\Seeder;

class TaskMediumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mediums')->insert([
         ['name' => 'Phone Call','icon'=>'ti-medall text-info'],
        ['name' => 'Email','icon'=>'ti-check text-success'],
        ['name' => 'Meeting','icon'=>'ti-id-badge text-primary'],
        ['name' => 'Social Network','icon'=>'ti-receipt text-info'],
        ['name' => 'Chat Facebook','icon'=>'ti-receipt text-info'],
        ['name' => 'Other','icon'=>'ti-receipt text-info'],
    ]);
    }
}
