<?php

namespace App\Imports;

use App\Models\areas;
use App\Models\degrees;
use App\Models\records;
use App\Models\temporal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoordinatorsImport implements ToModel, WithHeadingRow
{
    use Importable;
    public $areaS;
    public $grados;
    public function __construct()
    {
        $this->areaS = areas::pluck('ar_uID', 'ar_name');
        $this->grados = degrees::pluck('deg_uID', 'deg_name');
    }

    public function model(array $row)
    {
        $coordinador = User::where('us_banner_id', base64_encode($row['id']))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $num = $coordinador->count();

        ///////////COMPROBACION DE USUARIO EN TABLA USUARIOS
        if ($num == 0) {
            $register =
                User::create([
                    'us_uID' => Str::uuid(),
                    'us_banner_id' =>  base64_encode($row['id']),
                    'name' => Crypt::encryptString($row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']),
                    'deg_uID' => $this->areaS[$row['grado']],
                    'ar_uID' => $this->areaS[$row['area'] . " " . $row['subarea']],
                    'email' => base64_encode($row['correo_institucional']),
                    'emailPersonal' => base64_encode($row['correo_alternativo']),
                    'rol_uID' => 'a71bd1e8-bf2e-4a7b-89e4-47363d300f56',
                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                    'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
                ]);

            $exist = $register->us_uID;
        } else {
            $temporalR = $coordinador->first();
            $exist = $temporalR->us_uID;
        }
        //COMPROBACION DE USUARIO EN TABLA TEMPORAL
        $temp = temporal::where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');

        $numT = $temp->count();
        if ($numT == 0) {
            temporal::create([
                'temp_uID' => Str::uuid(),
                'us_uID' => $exist,
                'rol' => $row['tipo'],
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                'created_by' => Auth::user()->us_uID,
            ]);
            $exist = $register->us_uID;
        } else {
            $recR = $coordinador->first();
            $exist = $recR->us_uID;
        }
        //COMPROBACION DE USARIO EN TABLA RECORDS
        $rec = records::where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where("conv_uID", $this->conv_uID);
        $numR = $rec->count();
        if ($numR == 0) {
            records::create([
                'rec_uID' => Str::uuid(),
                'us_uID' => $exist,
                'rol' =>  $row['tipo'],
                'conv_uID' => '47713a69-f65e-4b6a-a2fc-959a7674a7bd',
                'ar_uID' => '43b04950-9a78-4f2d-bc96-e297caf7cc95',
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);

        }
    }
}
