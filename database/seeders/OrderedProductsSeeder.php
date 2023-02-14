<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\OrderedProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class OrderedProductsSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        DB::table('ordered_products')->insert([
            [
                'customer_orders_id' => 1,
                'customers_id' => 1,
                'product_id' => '1',
                'quantity' => 1,
                'created_at' => Carbon::create(2023, 1, 9, 0),
                'updated_at' => Carbon::create(2023, 1, 9, 0),
            ],[
                'customer_orders_id' => 1,
                'customers_id' => 1,
                'product_id' => '5',
                'quantity' => 2,
                'created_at' => Carbon::create(2023, 1, 9, 0),
                'updated_at' => Carbon::create(2023, 1, 9, 0),
            ],[
                'customer_orders_id' => 2,
                'customers_id' => 1,
                'product_id' => '2',
                'quantity' => 2,
                'created_at' => Carbon::create(2023, 2, 9, 0),
                'updated_at' => Carbon::create(2023, 2, 9, 0),
            ],[
                'customer_orders_id' => 3,
                'customers_id' => 2,
                'product_id' => '2',
                'quantity' => 3,
                'created_at' => Carbon::create(2023, 2, 9, 0),
                'updated_at' => Carbon::create(2023, 2, 9, 0),
            ],[
                'customer_orders_id' => 4,
                'customers_id' => 3,
                'product_id' => '3',
                'quantity' => 5,
                'created_at' => Carbon::create(2023, 3, 9, 0),
                'updated_at' => Carbon::create(2023, 3, 9, 0),
            ],[
                'customer_orders_id' => 5,
                'customers_id' => 4,
                'product_id' => '4',
                'quantity' => 3,
                'created_at' => Carbon::create(2023, 3, 9, 0),
                'updated_at' => Carbon::create(2023, 3, 9, 0),
            ],[
                'customer_orders_id' => 6,
                'customers_id' => 1,
                'product_id' => 10,
                'quantity' => 2,
                'created_at' => Carbon::create(2023, 4, 9, 0),
                'updated_at' => Carbon::create(2023, 4, 9, 0),
            ],
            [
                'customer_orders_id' => 7,
                'customers_id' => 1,
                'product_id' => 13,
                'quantity' => 3,
                'created_at' => Carbon::create(2023, 5, 9, 0),
                'updated_at' => Carbon::create(2023, 5, 9, 0),
            ],
            [
                'customer_orders_id' => 8,
                'customers_id' => 1,
                'product_id' => 16,
                'quantity' => 3,
                'created_at' => Carbon::create(2023, 6, 9, 0),
                'updated_at' => Carbon::create(2023, 6, 9, 0),
            ],
        ]);
    }
}
