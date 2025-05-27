<?php
namespace Database\Seeders;

use Database\Seeders\ProductsTableSeeder;
use Database\Seeders\TablesSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TablesSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}