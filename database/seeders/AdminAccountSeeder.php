<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mark Joseph Manalo',
            'email' => 'godentalsph@gmail.com',
            'phone_number' => '09452692274',
            'address' => '283 Ramos Compound Baesa Quezon City',
            'password' => 'Onepiece25!',
            'gender' => 'male',
            'age'=>'20'
        ]);
        $user->assignRole('Super Admin');
        User::create([
            'name' => 'Mark Joseph Manalo',
            'email' => 'programmingmind1110@gmail.com',
            'phone_number' => '09369332354',
            'address' => '283 Ramos Compound Baesa Quezon City',
            'password' => 'Onepiece25!',
            'gender' => 'male',
            'age'=>'20'
        ])->assignRole('manager');


    }
}
