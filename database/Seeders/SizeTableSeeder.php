<?php

namespace Database\Seeders;
use App\Size;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
   
    public function run()
    {
        
       
        $locations = json_decode(file_get_contents(storage_path() . "/sizes.json"), true);

        foreach ($locations['sizes'] as $key => $value) {
            Size::create([
                "name" => $value['name'],
                "id" => $value['id'],
               
            ]);
        }

    }
}
