<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('departments')->insert([
          ['id'=>1,'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','dep_uID'=>'f0b64868-17f4-47cf-a618-8b7d04d1c663','dep_name' => 'Vicerrectoría Académica','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=>2,'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','dep_uID'=>'10dd44fc-d790-4496-be77-107492ff7501','dep_name' => 'Vicerrectoría de Administración y Finanzas','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=>3,'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','dep_uID'=>'7166ca3d-b710-44e8-ad77-e845abbc164d','dep_name' => 'Vicerrectoría de Formación Integral','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=>4,'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','dep_uID'=>'c2c030ef-34de-49e5-975e-f731bd29f862','dep_name' => 'Rectoría','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
