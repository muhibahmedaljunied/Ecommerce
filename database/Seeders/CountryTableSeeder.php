<?php

namespace Database\Seeders;
use App\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/countries.json"), true);

 
        foreach ($locations['countries'] as $key => $value) {
   
            Country::create([
                "name" => $value['name'],
                "id" => $value['id'],
               
            ]);
        }
    }
}
