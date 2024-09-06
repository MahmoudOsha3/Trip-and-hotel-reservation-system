<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OwnerCompany ;
use Illuminate\Support\Facades\Hash;


class OwnerCompanyFactory extends Factory
{
    protected $model = OwnerCompany::class ;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('123456789') ,
            'phone' => $this->faker->numerify('#########'),
        ];
    }
}
