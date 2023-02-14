<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Storage::disk('public')->exists('product_photos'))
        {
            Storage::disk('public')->makeDirectory('product_photos', 0775, true);
        }
        if(!Storage::disk('public')->exists('banner'))
        {
            Storage::disk('public')->makeDirectory('banner', 0775, true);
        }
        if(!Storage::disk('public')->exists('customer_profile_picture'))
        {
            Storage::disk('public')->makeDirectory('customer_profile_picture', 0775, true);
        }
        if(!Storage::disk('public')->exists('employee_profile_picture'))
        {
            Storage::disk('public')->makeDirectory('employee_profile_picture', 0775, true);
        }
    }
}
