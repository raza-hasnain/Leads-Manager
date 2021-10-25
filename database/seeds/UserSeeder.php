<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->insert([
            'id'=>1,
            'name' => 'Administrator',
           'email' => 'aliraza170@gmail.com',
            'password' => Hash::make('Raza110_'),
            'status'  => 1,
            'role_id'  => 1,
                    ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

