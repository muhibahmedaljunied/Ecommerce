<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
   
    public function run()
    {
        $locations = json_decode(file_get_contents(storage_path() . "/users.json"), true);

      
        foreach ($locations['users'] as $key => $value) {
        ;
            User::create([
                "id" => $value['id'],
                'name' => $value['name'],
                'email' => $value['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
               
               
            ]);

   

        }
    }
}
