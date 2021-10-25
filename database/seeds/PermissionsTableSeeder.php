<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([

        ['id' => '1',
          'key' => 'browse_Customers',
          'module_id' => 1,
          'display_name' => 'Browse'
        ],['id' => '2',
          'key' => 'view_Customers',
          'module_id' => 1,
          'display_name' => 'View'
        ],['id' => '3',
          'key' => 'own_Customers',
          'module_id' => 1,
          'display_name' => 'own(view)'
        ],['id' => '4',
          'key' => 'add_Customers',
          'module_id' => 1,
          'display_name' => 'create'
        ],['id' => '5',
          'key' => 'edit_Customers',
          'module_id' => 1,
          'display_name' => 'edit'
        ],['id' => '6',
          'key' => 'send_Customers',
          'module_id' => 1,
          'display_name' => 'send_mail_message'
        ],['id' => '7',
          'key' => 'export_Customers',
          'module_id' => 1,
          'display_name' => 'export_download'
        ],['id' => '8',
          'key' => 'delete_Customers',
          'module_id' => 1,
          'display_name' => 'delete'
        ], ['id' => '9',
          'key' => 'browse_Leads',
          'module_id' => 2,
          'display_name' => 'Browse'
        ],['id' => '10',
          'key' => 'view_Leads',
          'module_id' => 2,
          'display_name' => 'View'
        ],['id' => '11',
          'key' => 'own_Leads',
          'module_id' => 2,
          'display_name' => 'own(view)'
        ],['id' => '12',
          'key' => 'add_Leads',
          'module_id' => 2,
          'display_name' => 'create'
        ],['id' => '13',
          'key' => 'edit_Leads',
          'module_id' => 2,
          'display_name' => 'edit'
        ],['id' => '14',
          'key' => 'send_Leads',
          'module_id' => 2,
          'display_name' => 'send_mail_message'
        ],['id' => '15',
          'key' => 'export_Leads',
          'module_id' => 2,
          'display_name' => 'export_download'
        ],['id' => '16',
          'key' => 'delete_Leads',
          'module_id' => 2,
          'display_name' => 'delete'
        ],['id' => 17,
            'key' => 'browse_FacebookPosts',
          'module_id' => 3,
          'display_name' => 'Browse'
        ],['id' => 18,
            'key' => 'mediapost_FacebookPosts',
          'module_id' => 3,
          'display_name' => 'media_post'
        ],['id' => 19,
            'key' => 'linkpost_FacebookPosts',
          'module_id' => 3,
          'display_name' => 'link_post'
        ],['id' => 20,
            'key' => 'delete_FacebookPosts',
          'module_id' => 3,
          'display_name' => 'delete'
        ],['id' => 21,
            'key' => 'settings_FacebookPosts',
          'module_id' => 3,
          'display_name' => 'settings'
        ], ['id' => 22,
          'key' => 'browse_Sales',
          'module_id' => 4,
          'display_name' => 'Browse'
        ],['id' => 23,
          'key' => 'browse_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'Browse_estimates'
        ],['id' => 24,
          'key' => 'view_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'View'
        ],['id' => 25,
          'key' => 'own_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'own(view)'
        ],['id' => 26,
          'key' => 'add_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'create'
        ],['id' => 27,
          'key' => 'edit_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'edit'
        ],['id' => 28,
          'key' => 'delete_estimates_Sales',
          'module_id' => 4,
          'display_name' => 'delete'
        ],['id' => 29,
          'key' => 'browse_items_Sales',
          'module_id' => 4,
          'display_name' => 'browse_items'
        ],['id' => 30,
          'key' => 'view_items_Sales',
          'module_id' => 4,
          'display_name' => 'View'
        ],['id' => 31,
          'key' => 'add_items_Sales',
          'module_id' => 4,
          'display_name' => 'create'
        ],['id' => 32,
          'key' => 'edit_items_Sales',
          'module_id' => 4,
          'display_name' => 'edit'
        ],['id' => 33,
          'key' => 'delete_items_Sales',
          'module_id' => 4,
          'display_name' => 'delete'
        ],['id' => 34,
          'key' => 'browse_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'Browse_proposals'
        ],['id' => 35,
          'key' => 'view_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'View'
        ],['id' => 36,
          'key' => 'own_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'own(view)'
        ],['id' => 37,
          'key' => 'add_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'create'
        ],['id' => 38,
          'key' => 'edit_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'edit'
        ],['id' => 39,
          'key' => 'delete_proposals_Sales',
          'module_id' => 4,
          'display_name' => 'delete'
        ],['id' => 40,
          'key' => 'browse_Settings',
          'module_id' => 5,
          'display_name' => 'Browse'
        ],['id' => 41,
          'key' => 'browse_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'Browse_invoice'
        ],['id' => 42,
          'key' => 'view_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'View'
        ],['id' => 43,
          'key' => 'own_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'own(view)'
        ],['id' => 44,
          'key' => 'add_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'create'
        ],['id' => 45,
          'key' => 'edit_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'edit'
        ],['id' => 46,
          'key' => 'delete_invoice_Sales',
          'module_id' => 4,
          'display_name' => 'delete'
        ]

      ]);
    }
}
