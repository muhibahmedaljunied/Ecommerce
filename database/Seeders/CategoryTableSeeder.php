<?php

namespace Database\Seeders;
use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/categories.json"), true);

 
        foreach ($locations['categories'] as $key => $value) {
      
            Category::create([
                "name" => $value['name'],
                "id" => $value['id'],
               
            ]);
        }
    }
}
