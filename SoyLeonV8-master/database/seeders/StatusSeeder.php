<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('statuses')->insert([
          ['id'=>1,'sta_uID'=>'9569bcce-0869-40b9-b6c5-c7b72c91996a','name' => 'Inactivo','description' => '','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 2, 'sta_uID'=>'023584f1-5547-429a-a131-3b3810d156c7','name' => 'Activo','description' => '','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=> 3, 'sta_uID'=>'f567f85f-096c-4173-ac41-6b624d7024d4','name' => 'Pendiente','description' => '','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
