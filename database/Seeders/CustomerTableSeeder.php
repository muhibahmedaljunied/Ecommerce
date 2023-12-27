<?php

namespace Database\Seeders;
use App\Models\customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/customers.json"), true);

       
        foreach ($locations['customers'] as $key => $value) {
      
            Customer::create([
                "id" => $value['id'],
                "first_name" => $value['first_name'],
                "last_name" => $value['last_name'],
                "email_address" => $value['email_address'],
                "phone_no" => $value['phone_no'],
             
               
            ]);


       

        }
    }
}
