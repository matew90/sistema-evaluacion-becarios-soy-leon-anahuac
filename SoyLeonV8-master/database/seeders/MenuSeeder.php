<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
              ['id'=> 1 ,'men_uID'=>'a36f31ae-b56e-4022-ad2c-6fcd67870119','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_uID'=>'44466e93-c5fd-4ec2-a5df-fc4b420b9de6', 'men_name' => 'Reserva de Espacios','men_slug' => 'reserva-espacios','men_icon' => 'fas fa-building','men_route' => 'reserva-espacios','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
              ['id'=> 2 ,'men_uID'=>'e46918c5-4d30-48df-86ab-576ac6b2f549','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','cat_uID'=>'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4', 'men_name' => 'Practicas Profesionales','men_slug' => 'practicas-profesionales','men_icon' => 'fas fa-espacio','men_route' => 'practicas-profesionales','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
