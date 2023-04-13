<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('spaces')->insert([
          ['spa_uID'=>Str::uuid(),'spa_name' => 'Aula Magna A','spa_person_number' => 20,'spa_color' => '#1ecab8','us_uID' => '1812d0a9-6dd0-48dd-9f1b-1dd5e9a92ec2','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'], 
          ['spa_uID'=>Str::uuid(),'spa_name' => 'Aula Magna B','spa_person_number' => 30,'spa_color' => '#fbb624','us_uID' => '1812d0a9-6dd0-48dd-9f1b-1dd5e9a92ec2','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['spa_uID'=>Str::uuid(),'spa_name' => 'Aula Magna C','spa_person_number' => 50,'spa_color' => '#00bcd4','us_uID' => '1812d0a9-6dd0-48dd-9f1b-1dd5e9a92ec2','sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
