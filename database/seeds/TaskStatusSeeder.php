<?php

use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('task_statuses')->insert([
            ['name' => 'Complete','icon'=>'ti-medall text-info'],
            ['name' => 'Awating Feedback','icon'=>'ti-check text-success'],
            ['name' => 'Testing','icon'=>'ti-id-badge text-primary'],
            ['name' => 'In Progress','icon'=>'ti-receipt text-info'],
            ['name' => 'Backlog','icon'=>'ti-receipt text-info'],

        ]);
    }
}
