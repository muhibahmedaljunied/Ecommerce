<?php

namespace Database\Seeders;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/attributes.json"), true);

 
        foreach ($locations['attributes'] as $key => $value) {
      
            Attribute::create([
                "id" => $value['id'],
                "name" => $value['name'],
                "code" => $value['code'],

               
            ]);
        }
    }
}
