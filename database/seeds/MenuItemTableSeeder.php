<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
          [
            'id' =>1,
            'title' => 'Dashboard',
            'menu_id' =>1,
            'icon' =>'ti-home',
            'parent_id' => null,
            'order' => 1,
            'route' => 'home',
            'model_name' => null,
            'module_id' => 0,
            'key' => null,

          ],[
            'id' =>2,
            'title' => 'Customers',
            'menu_id' =>1,
            'icon' =>'ti-user',
            'parent_id' => null,
            'order' => 2,
            'route' => 'customer.index',
            'model_name' => 'Modules\Customer\Entities\Customer',
            'module_id' => 1,
            'key' => null,
            
          ],[
            'id' =>3,
            'title' => 'Leads',
            'menu_id' =>1,
            'icon' =>'fas fa-tty',
            'parent_id' => null,
            'order' => 3,
            'route' => 'leads.index',
            'model_name' => 'Modules\Lead\Entities\Lead',
            'module_id' => 2,
            'key' => null,
          ],[
            'id' =>4,
            'title' => 'Facebook',
            'menu_id' =>1,
            'icon' =>'fa fa-facebook',
            'parent_id' => null,
            'order' => 4,
            'route' => null,
            'model_name' => 'Modules\FacebookPost\Entities\Postlist',
            'module_id' => 3,
            'key' => null,          ],
            [
            'id' =>5,
            'title' => 'Sales',
            'menu_id' =>1,
            'icon' =>'fa fa-shopping-cart',
            'parent_id' => null,
            'order' => 5,
            'route' => null,
            'model_name' => 'Modules\Sales\Entities\Estimate',
            'module_id' => 4,
            'key' => null,
          ],[
            'id' =>6,
            'title' => 'Settings',
            'menu_id' =>1,
            'icon' =>'ti-settings',
            'parent_id' => null,
            'order' => 6,
            'route' => 'settings.index',
            'model_name' => 'Modules\Settings\Entities\Pusher',
            'module_id' => 5,
            'key' => null,
          ],[
            'id' =>7,
            'title' => 'Post',
            'menu_id' =>1,
            'icon' =>'fa fa-facebook',
            'parent_id' => 4,
            'order' => 1,
            'route' => 'facebook.text_post',
            'model_name' => 'Modules\FacebookPost\Entities\postlist',
            'module_id' => null,
            'key' => 'mediapost',
          ],[
            'id' =>8,
            'title' => 'Link_Post',
            'menu_id' =>1,
            'icon' =>'fa fa-external-link',
            'parent_id' => 4,
            'order' => 2,
            'route' => 'facebook.link_post',
            'model_name' => 'Modules\FacebookPost\Entities\Postlist',
            'module_id' => null,
            'key' => 'linkpost',
          ],[
            'id' =>9,
            'title' => 'Timeline',
            'menu_id' =>1,
            'icon' =>'fas fa-stream',
            'parent_id' => 4,
            'order' => 3,
            'route' => 'facebook.fb_timeline',
            'model_name' => 'Modules\FacebookPost\Entities\Postlist',
            'module_id' => null,
            'key' => null,
          ],[
            'id' =>10,
            'title' => 'Settings',
            'menu_id' =>1,
            'icon' =>'ti-settings',
            'parent_id' => 4,
            'order' => 4,
            'route' => 'facebook.settings',
            'model_name' => 'Modules\FacebookPost\Entities\Postlist',
            'module_id' => null,
            'key' => 'settings',
          ],[
            'id' =>11,
            'title' => 'Estimate',
            'menu_id' =>1,
            'icon' =>'fa fa-calculator',
            'parent_id' => 5,
            'order' => 1,
            'route' => 'estimates.index',
            'model_name' => 'Modules\Sales\Entities\Estimate',
            'module_id' => null,
            'key' => 'browse_estimates',
        ],[
            'id' =>12,
            'title' => 'Items',
            'menu_id' =>1,
            'icon' =>'fa fa-list-alt',
            'parent_id' => 5,
            'order' => 4,
            'route' => 'items.index',
            'model_name' => 'Modules\Sales\Entities\Estimate',
            'module_id' => null,
            'key' => 'browse_items',
        ],[
            'id' =>13,
            'title' => 'Propsals',
            'menu_id' =>1,
            'icon' =>'fas fa-file-alt',
            'parent_id' => 5,
            'order' => 2,
            'route' => 'proposals.index',
            'model_name' => 'Modules\Sales\Entities\Estimate',
            'module_id' => null,
            'key' => 'browse_proposals',
        ],[
            'id' =>14,
            'title' => 'Invoice',
            'menu_id' =>1,
            'icon' =>'fas fa-file-alt',
            'parent_id' => 5,
            'order' => 3,
            'route' => 'invoice.index',
            'model_name' => 'Modules\Sales\Entities\Estimate',
            'module_id' => null,
            'key' => 'browse_invoice',
        ]

        ]);
    }
}
