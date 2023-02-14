<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home') ->insert([
            [
                'title' => 'Christmas Sale',
                'status' => "Active",
                'featured_image' => 'ChristmasSaleFinal.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Featured Image One',
                'status' => "Active",
                'featured_image' => 'Shopping.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'title' => 'Featured Image Two',
                'status' => "Active",
                'featured_image' => 'discount.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'title' => 'Featured Image One',
                'status' => "Active",
                'featured_image' => 'mega_sale.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
