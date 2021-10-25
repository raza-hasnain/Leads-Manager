<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('countries')->insert([
            [
                'id' => 1,
                'country_code' => 47,
                'name' =>'Norway',
                'min_digits' => 8,
                'max_digits' => 8,
                'iso' => 'NO',
                
            ],[
                'id' => 2,
                'country_code' => 95,
                'name' =>'Myanmar',
                'min_digits' => 11,
                'max_digits' =>11,
                'iso' => 'MY',
                
            ],[
                'id' => 3,
                'country_code' => 46,
                'name' =>'Sweden',
                'min_digits' => 8,
                'max_digits' =>10,
                'iso' => 'SW',
                
            ],
            [
                'id' => 4,
                'country_code' => 88,
                'name' =>'Bangladesh',
                'min_digits' => 8,
                'max_digits' =>10,
                'iso' => 'BD',
                
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
