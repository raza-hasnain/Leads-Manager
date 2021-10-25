<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
          [
            'id' =>1,
            'name' => 'admin'
          ],
          [
            'id' =>2,
            'name' => 'customer'
          ]

        ]);
    }
}
