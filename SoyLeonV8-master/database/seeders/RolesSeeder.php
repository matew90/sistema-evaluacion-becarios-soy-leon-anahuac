<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roles')->insert([
          ['id'=> 1, 'camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5','rol_uID'=>'18ffb841-deab-4835-bc3a-3c06b7c57fff','sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','rol_name' => 'STUDENT','rol_level'=>10,'rol_permissions' => '[]','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 2,'camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5', 'rol_uID'=>'ef4c62a5-dabf-4ff7-9d19-a6d68c1040ad','sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','rol_name' => 'FACULTY','rol_level'=>10,'rol_permissions' => '[]','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 3,'camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5', 'rol_uID'=>'2fdc25a3-5510-47f0-8a8d-86f18f9c415f','sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','rol_name' => 'FACULTY, STUDENT','rol_level'=>10,'rol_permissions' => '[]','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 4,'camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5', 'rol_uID'=>'a71bd1e8-bf2e-4a7b-89e4-47363d300f56','sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','rol_name' => 'ADMINISTRATIVE','rol_level'=>10,'rol_permissions' => '[]','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 5,'camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5', 'rol_uID'=>'36b0bee9-ea69-441d-a6c3-76ab7d8710a3','sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','rol_name' => 'ADMINISTRATOR','rol_level'=>100,'rol_permissions' => '[]','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
