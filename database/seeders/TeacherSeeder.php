<?php

namespace Database\Seeders;

use App\Models\teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (teacher::count() == 0) {
            teacher::factory(88)->create();
        }
    }
}
