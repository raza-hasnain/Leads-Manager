<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstimateStatusTableSeeder extends Seeder
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
            ['name' => 'Draft','icon'=>'ti-save text-info','status' => null],
            ['name' => 'Sent','icon'=>'ti-check text-primary','status' => null],
            ['name' => 'Expired','icon'=>'ti-time text-warning','status' => null],
            ['name' => 'Declined','icon'=>'ti-na text-danger','status' => 0],
            ['name' => 'Accepted','icon'=>'ti-check text-success','status' => 1],
        ]);
    }
}
