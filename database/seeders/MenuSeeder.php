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
              ['id'=> 1 ,'men_uID'=>'a36f31ae-b56e-4022-ad2c-6fcd67870119','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_uID'=>'44466e93-c5fd-4ec2-a5df-fc4b420b9de6', 'men_name' => 'Inicio','men_slug' => 'inicio','men_icon' => 'fas fa-house','men_route' => 'main-dashboard','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
              ['id'=> 2 ,'men_uID'=>'a36f31ae-b56e-4022-ad2c-6fcd67870119','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_uID'=>'44466e93-c5fd-4ec2-a5df-fc4b420b9de6', 'men_name' => 'Reserva de Espacios','men_slug' => 'reserva-espacios','men_icon' => 'fas fa-building','men_route' => 'reserva-espacios','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
              ['id'=> 3 ,'men_uID'=>'e46918c5-4d30-48df-86ab-576ac6b2f549','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','cat_uID'=>'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4', 'men_name' => 'Practicas Profesionales','men_slug' => 'practicas-profesionales','men_icon' => 'fas fa-espacio','men_route' => 'practicas-profesionales','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
              ['id'=> 4 ,'men_uID'=>'g47919c5-7g45-49df-87bc-586df6b2f550','sta_uID'=> '024594f2-5849-429a-b131-4b3810d156c7','cat_uID'=>'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4', 'men_name' => 'Evaluacion de Becarios','men_slug' => 'evaluacion-becarios','men_icon' => 'fad fa-graduation-cap','men_route' => 'evaluacion-becarios','created_at' => '2023-01-23 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
              ['id'=> 5 ,'men_uID'=>'a7d4214c-2b4a-43b5-8050-07fcf1350c3a','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','cat_uID'=>'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4', 'men_name' => 'Administrador','men_slug' => 'administrador','men_icon' => 'fas fa-cogs','men_route' => 'administrador','created_at' => '2023-01-23 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
