<?php

use Illuminate\Database\Seeder;

class InvoiceStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoicestatus')->insert([
            ['name' => 'Paid','icon'=>'ti-medall text-info','status'=>1],
            ['name' => 'Unpaid','icon'=>'ti-check text-success','status'=>0],
            ['name' => 'Partially paid','icon'=>'ti-id-badge text-primary','status'=>2],
            ['name' => 'Over due','icon'=>'ti-receipt text-info','status'=>3],
            ['name' => 'cancelled','icon'=>'ti-receipt text-info','status'=>4],
            ['name' => 'draft','icon'=>'ti-receipt text-info','status'=>null],

        ]);
    }
}
