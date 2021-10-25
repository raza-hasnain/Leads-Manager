<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstimateStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estimate_statuses')->truncate();

        DB::table('estimate_statuses')->insert([
            ['name' => __('layout.draft'),'icon'=>'ti-save text-info','status'=>null],
            ['name' => __('layout.sent'),'icon'=>'ti-check text-primary','status'=>null],
            ['name' => __('layout.expired'),'icon'=>'ti-time text-warning','status'=>null],
            ['name' => __('layout.declined'),'icon'=>'ti-na text-danger','status'=>'0'],
            ['name' => __('layout.accepted'),'icon'=>'ti-check text-success','status'=>'1'],
        ]);
    }
}
