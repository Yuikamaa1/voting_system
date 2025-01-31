<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
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
            'teacher_name' => $this->faker->name,
            'tsc_no' => strtoupper($this->faker->unique()->bothify('####')),
            'gender' => $gender[random_int(0, 1)],
            'position' => $this->faker->randomElement(['Senior Teacher', 'Teacher','Teacher on Practice']),
            'status' => 'Active',

        ];
    }
}
