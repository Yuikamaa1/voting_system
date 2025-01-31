<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BookIssueSeeder::class,
            BookSeeder::class,
            SettingsSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
        ]);
    }
}
