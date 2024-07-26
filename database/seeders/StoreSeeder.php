<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample stores
        Store::create(['name' => 'Store 1','slug' => 'store-1', 'address' => '123 Main St']);
        Store::create(['name' => 'Store 2', 'slug' => 'store-1','address' => '456 Elm St']);
        Store::create(['name' => 'Store 3', 'slug' => 'store-1','address' => '789 Maple Ave']);
        // Add more stores as needed
    }
}

