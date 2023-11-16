<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            CountryTableSeeder::class,
            SizeTableSeeder::class,
            CustomerTableSeeder::class,
       
        ]);
     }
}
