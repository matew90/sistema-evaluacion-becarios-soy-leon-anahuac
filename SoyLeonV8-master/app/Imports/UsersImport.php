<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
			'name'=> Crypt::encryptString( $row[0]),
        'email'=> base64_encode($row[1]),
        'role_id'=> 4,
        'campus_id'=> 1,
        'area_id'=> $row[2],
        'status_id'=> 2,
		'us_uID'=>Str::uuid(),
        'us_banner_id'=> Crypt::encryptString($row[3])
        ]);
    }
}
