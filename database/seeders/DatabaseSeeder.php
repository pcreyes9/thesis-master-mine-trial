<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CustomerOrderSeeder;
use Database\Seeders\OrderedProductsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FolderSeeder::class);
        $this->call(RoleAndPermissionsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(AdminAccountSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerShippingAddressSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(CustomerCartSeeder::class);
        $this->call(OrderedProductsSeeder::class);
        $this->call(CustomerOrderSeeder::class);

    }
}
