<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
use App\Models\Place;
use App\Models\Company;


class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'title' => [
                'en' => $this->faker->sentence, // عنوان الرحلة بالإنجليزية
                'ar' => $this->faker->sentence, // عنوان الرحلة بالعربية
            ],
            'sub_description' => [
                'en' => $this->faker->text(50), // وصف قصير بالإنجليزية
                'ar' => $this->faker->text(50), // وصف قصير بالعربية
            ],
            'description' => [
                'en' => $this->faker->paragraph, // وصف كامل بالإنجليزية
                'ar' => $this->faker->paragraph, // وصف كامل بالعربية
            ],
            'date_trip' => $this->faker->dateTimeBetween('now', '+1 year'),
            'price' => $this->faker->randomFloat(2, 100, 1000), // سعر الرحلة
            'count_seats' => $this->faker->numberBetween(10, 100), // عدد المقاعد
            'booking_seats' => $this->faker->numberBetween(0, 10), // المقاعد المحجوزة
            'place_trip_id' => Place::inRandomOrder()->first()->id , // يربط الرحلة بمكانها
            'company_id' => Company::factory(), // يربط الرحلة بالشركة
            'status_booking' => $this->faker->randomElement(['available_booking' , 'complete_booking' , 'close_booking']), // حالة الحجز
        ];
    }
}
