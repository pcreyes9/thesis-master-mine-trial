<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Customer;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers') ->insert([
            [
                'name' => 'Mark Joseph Manalo',
                'email' => 'markjosephmanalo1110@gmail.com',
                'email_verified_at' => now(),
                'phone_number' => '09452692274',
                'password' => bcrypt('Onepiece25!'),
                'gender' => 'Male',
                'birthday'=>'2001-06-08',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gene Vincent Soriano',
                'email' => 'programmingmind1110@gmail.com',
                'email_verified_at' => null,
                'phone_number' => '09452692274',
                'password' => bcrypt('Onepiece25!'),
                'gender' => 'Male',
                'birthday'=>'2001-06-08',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        Customer::factory(100)->create();
    }
}
