<?php

namespace Database\Seeders;
use App\Models\AttributeFamily;
use Illuminate\Database\Seeder;

class AttributeFamilyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/attribute_families.json"), true);

 
        foreach ($locations['attribute_families'] as $key => $value) {
      
            AttributeFamily::create([
                "id" => $value['id'],
                "name" => $value['name'],
                "code" => $value['code'],
               
            ]);
        }
    }
}
