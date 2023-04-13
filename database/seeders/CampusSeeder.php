<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campuses')->insert([
          ['id'=>1,'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7','camp_uID'=>'31eec942-8945-4096-8815-b39e97f782c5', 'cam_name' => 'Universidad Anáhuac Querétaro','cam_nickname' => 'UAQ','created_at' => '2022-12-15 11:22:44', 'updated_at' => '2022-12-15 11:22:44'],
      ]);
    }
}
