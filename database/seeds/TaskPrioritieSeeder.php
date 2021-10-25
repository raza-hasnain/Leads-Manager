<?php

use Illuminate\Database\Seeder;

class TaskPrioritieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('priorities')->insert([
        ['name' => 'Urgent','icon'=>'ti-medall text-info'],
        ['name' => 'High','icon'=>'ti-check text-success'],
        ['name' => 'Medium','icon'=>'ti-id-badge text-primary'],
        ['name' => 'Low','icon'=>'ti-receipt text-info'],
    ]);
        
    }
}
