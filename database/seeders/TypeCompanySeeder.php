<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeCompany ;

class TypeCompanySeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'title' => ['en' => 'Hotel Company' , 'ar' => 'شركة فندقية']
            ],
            [
                'title' => ['en' => 'Tourism Company' , 'ar' => 'شركة سياحية']
            ]
        ] ;

        foreach($types as $type)
        {
            TypeCompany::create($type) ;
        }
    }
}
