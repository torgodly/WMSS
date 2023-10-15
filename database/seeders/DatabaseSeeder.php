<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Warehouse::factory(100)->create();
        \App\Models\Product::factory(1000)->create();


        //attach each warehouse with 10 products and random quantity and random margin between 0 and 25


        $warehouses = Warehouse::all();

        foreach ($warehouses as $warehouse) {
            $warehouse->products()->attach(\App\Models\Product::all()->random(10)->pluck('id')->toArray(), [
                'quantity' => rand(0, 100),
                'margin' => rand(0, 25),
            ]);
        }

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);
    }
}
