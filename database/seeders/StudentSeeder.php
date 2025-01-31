<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Student::count() == 0) {
            Student::factory(100)->create();
        }
    }
}
