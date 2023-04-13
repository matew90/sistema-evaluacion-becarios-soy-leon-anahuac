<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          ['id'=>1,'cat_uID'=>'44466e93-c5fd-4ec2-a5df-fc4b420b9de6','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_name' => "Administrativos", 'created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=>2,'cat_uID'=>'53e69a5f-12a5-4785-a563-c6f76282e06f','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_name' => "Profesores",'created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
          ['id'=>3,'cat_uID'=>'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4','sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'cat_name' => "Estudiantes",'created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
    ]);
    }
}
