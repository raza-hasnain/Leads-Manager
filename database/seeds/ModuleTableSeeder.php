<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'id' =>1,
                'name' => 'Customers',
                'slug' =>'Customer',
                'display_name' => 'Customers',
                'model_name' => 'Modules\Customer\Entities\Customer',
                'settingable' => 0,
                'policy_name' =>null
            ], [
                'id' =>2,
                'name' => 'Leads',
                'slug' =>'Lead',
                'display_name' => 'Leads',
                'model_name' => 'Modules\Lead\Entities\Lead',
                'settingable' => 1,
                'policy_name' =>null
            ], [
                'id' =>3,
                'name' => 'FacebookPosts',
                'slug' =>'FacebookPost',
                'display_name' => 'Facebook',
                'model_name' => 'Modules\FacebookPost\Entities\Postlist',
                'settingable' => 0,
                'policy_name' =>null
            ], [
               'id' =>4,
                'name' => 'Sales',
                'slug' =>'Sales',
                'display_name' => 'Sales',
                'model_name' => 'Modules\Sales\Entities\Estimate',
                'settingable' => 1,
                'policy_name' =>null
            ], [
                'id' =>5,
                'name' => 'Settings',
                'slug' =>'Settings',
                'display_name' => 'Settings',
                'model_name' => 'Modules\Settings\Entities\Pusher',
                'settingable' => 0,
                'policy_name' =>null
            ]
        ]);
    }
}
