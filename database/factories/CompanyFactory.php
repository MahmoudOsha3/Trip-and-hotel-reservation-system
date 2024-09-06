<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Company , OwnerCompany};


class CompanyFactory extends Factory
{
    protected $model = Company::class ;
    public function definition()
    {
        return [
            'title' => [
                'en' => $this->faker->company, // اسم الشركة بالإنجليزية
                'ar' => $this->faker->company, // اسم الشركة بالعربية
            ],
            'about_company' => [
                'en' => $this->faker->paragraph, // وصف الشركة بالإنجليزية
                'ar' => $this->faker->paragraph, // وصف الشركة بالعربية
            ],
            'address' => $this->faker->address,
            'contact_number' => $this->faker->numerify('#########'),
            'type_company_id' => $this->faker->numberBetween(2,2), // حسب النوع المحدد
            'owner_id' => OwnerCompany::factory(), // يربط الشركة مع مالكها
        ];
    }
}
