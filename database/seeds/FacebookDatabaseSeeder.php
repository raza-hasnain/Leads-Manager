<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FacebookDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('callactions')->insert([
          [
              'id' =>1,
            'name' => 'LEARN_MORE',
            'display_name' =>'Learn More',
            'link_able' => 1
              ],
                [
              'id' =>2,
            'name' => 'MESSAGE_PAGE',
            'display_name' =>'Send Message',
            'link_able' => 0
              ], [
              'id' =>3,
            'name' => 'OPEN_LINK',
            'display_name' =>'Open Link',
            'link_able' => 1
              ],[
              'id' =>4,
            'name' => 'SIGN_UP',
            'display_name' =>'Sign Up',
            'link_able' => 1
              ],[
              'id' =>5,
            'name' => 'SUBSCRIBE',
            'display_name' =>'Subscribe',
            'link_able' => 1
              ],[
              'id' =>6,
            'name' => 'BOOK_TRAVEL',
            'display_name' =>'Book Now',
            'link_able' => 1
              ],[
              'id' =>7,
            'name' => 'DOWNLOAD',
            'display_name' =>'Download',
            'link_able' => 1
              ],[
              'id' =>8,
            'name' => 'WATCH_MORE',
            'display_name' =>'Watch More',
            'link_able' => 1
              ],[
              'id' =>9,
            'name' => 'WATCH_VIDEO',
            'display_name' =>'Watch Video',
            'link_able' => 1
              ]


        ]);
        
    }
}
