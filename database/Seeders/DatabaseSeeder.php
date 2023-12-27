<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            // AttributeTableSeeder::class,
            // AttributeFamilyTableSeeder::class,
            CustomerTableSeeder::class,
            
       
        ]);
     }
}
