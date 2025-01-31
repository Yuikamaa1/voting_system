<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_name' => $this->faker->randomElement([
                'The Great Gatsby',
                'To Kill a Mockingbird',
                '1984',
                'Pride and Prejudice',
                'The Catcher in the Rye',
                'The Hobbit',
                'Moby Dick',
                'War and Peace',
                'The Adventures of Sherlock Holmes',
                'Jane Eyre',
            ]),
            'book_number' => $this->faker->unique()->numerify('BOOK-#####') . '-' . now()->year,
            'subject' => $this->faker->randomElement(['Math', 'Physics', 'Agriculture']),
            'edition' => $this->faker->numberBetween(1, 10),
            'status' => 'Available',
        ];
    }
}
