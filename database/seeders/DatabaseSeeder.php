<?php

// namespace Database\Seeders;

// // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     public function run()
//     {
//         return [
//             AdminSeeder::class,
//             TypeCompanySeeder::class
//         ];
//     }
// }

use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\OwnerCompany;
use App\Models\Company;
use App\Models\Trip;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $owners = OwnerCompany::factory()->count(20)->create();
        $companies = Company::factory()->count(100)->create();
        $trips = Trip::factory()->count(200)->create();
    }
}
