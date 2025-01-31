<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['male', 'female'];
        return [
            'name' => $this->faker->name,
            'class' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'admission_no' => strtoupper($this->faker->unique()->bothify('####')),
            'admission_date' => $this->faker->date(),
            'gender' => $gender[random_int(0, 1)],
            'parent_phone' => $this->faker->phoneNumber,
        ];
    }
}
