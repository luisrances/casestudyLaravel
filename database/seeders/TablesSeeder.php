<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesSeeder extends Seeder 
{
    public function run()
    {
        // Disable foreign key checks to allow truncating tables with relations
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('wishlists')->truncate();
        DB::table('carts')->truncate();
        DB::table('orders')->truncate();
        DB::table('user_profilings')->truncate();
        DB::table('payment_details')->truncate();
        DB::table('accounts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data = json_decode(file_get_contents(database_path('seeders/data/seed_data.json')), true);

        DB::table('accounts')->insert($data['accounts']);
        DB::table('payment_details')->insert($data['payment_details']);
        DB::table('user_profilings')->insert($data['user_profilings']);
        DB::table('orders')->insert($data['orders']);
        DB::table('carts')->insert($data['carts']);
        DB::table('wishlists')->insert($data['wishlists']);
    }
}
