<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            StatusSeeder::class,
            DepartmentsSeeder::class,
            AreasSeeder::class,
            CampusSeeder::class,
            CategorySeeder::class,
            MenuSeeder::class,
            RolesSeeder::class,
            SpacesSeeder::class,
          ]);
    }
}
