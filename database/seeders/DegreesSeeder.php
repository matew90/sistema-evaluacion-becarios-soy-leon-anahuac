<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('degrees')->insert([
            ['id'=>1,'deg_uID'=>'22299e93-c5fd-4ec8-a57f-fc4i420b9de6', 'deg_name' => "Lic.",'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'created_at' => '2023-02-22 14:39:44', 'updated_at' => '2023-02-22 14:39:44'],
            ['id'=>2,'deg_uID'=>'53f69a5f-12a8-47g5-a569-c6f76292e06f', 'deg_name' => "Mtr.",'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','created_at' => '2023-02-22 14:39:44', 'updated_at' => '2023-02-22 14:39:44'],
            ['id'=>3,'deg_uID'=>'e6597gc9-0d81-8cv5-ao15-6dc2u9df52f4','deg_name' => "Doc.",'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7', 'created_at' => '2023-02-22 14:39:44', 'updated_at' => '2023-02-22 14:39:44'],
      ]);
    }
}
