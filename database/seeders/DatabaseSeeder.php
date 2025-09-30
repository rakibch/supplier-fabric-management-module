<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);

    \App\Models\Supplier::factory(8)->create()->each(function($supplier) {
        \App\Models\Fabric::factory(rand(1,4))->create(['supplier_id' => $supplier->id]);
    });

    // Add some stocks
    \App\Models\Fabric::all()->each(function($fabric) {
        \App\Models\FabricStock::create([
            'fabric_id' => $fabric->id,
            'type' => 'in',
            'qty' => rand(10,100),
            'created_by' => 1
        ]);
        \App\Models\FabricStock::create([
            'fabric_id' => $fabric->id,
            'type' => 'out',
            'qty' => rand(0,10),
            'created_by' => 1
        ]);
    });
    }
}
