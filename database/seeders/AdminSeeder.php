<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin ;
use Hash ;

class AdminSeeder extends Seeder
{

    public function run()
    {
        Admin::create([
            'name' => 'Mahmoud' ,
            'email' => 'mahmoud@gmail.com' ,
            'password' => Hash::make('123456789') ,
            'role' => 'owner',
        ]);
    }
}
