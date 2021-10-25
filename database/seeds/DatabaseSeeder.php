<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
         	EstimateStatusTableSeeder::class,
         	FacebookDatabaseSeeder::class,
         	LeadSourcesTableSeeder::class,
         	LeadStatusesTableSeeder::class,
         	UserSeeder::class,
         	CompanySettingTableSeeder::class,
         	CountryTableSeeder::class,
         	MenuItemTableSeeder::class,
         	MenusTableSeeder::class,
         	ModuleTableSeeder::class,
         	PermissionsTableSeeder::class,
         	RoleTableSeeder::class,
            InvoiceStatusSeed::class,
            TaskStatusSeeder::class,
            TaskPrioritieSeeder::class,
            TaskMediumSeeder::class,
            TaskResolutionSeeder::class,
         	]);
    }
}
