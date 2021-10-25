<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CompanySettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('company_settings')->insert([
            [
                'id' => 1,
                'name' => 'crm',
                'phone_no' =>'123456789',
                'phone_code' => 88,
                'address' => 'crm,Dhaka',
                'updated_by'=> 1,
                'city' => 'Dhaka',
                'postal_code' => '1229',
                'copy_right' =>'Copyright © 2020',
                'footer_container' =>'All rights reserved.',
                'country_id' => 4
                
            ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
