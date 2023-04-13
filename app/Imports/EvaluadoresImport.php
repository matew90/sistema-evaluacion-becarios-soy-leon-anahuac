<?php

namespace App\Imports;

use App\Models\areas;
use App\Models\degrees;
use App\Models\records;
use App\Models\temporal;
use App\Models\User;
use App\Models\convocations;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EvaluadoresImport implements ToModel, WithHeadingRow
{

    use Importable;

    public $areaS;
    public $grados;
    public $conv_uID;
    public function __construct($conv_uID)
    {
        $this->areaS = areas::pluck('ar_uID', 'ar_name');
        $this->grados = degrees::pluck('deg_uID', 'deg_name');
        $this->conv_uID = $conv_uID;

    }

    function getModel(array $row, User $us)
    {
        $us->base64_encode($row['id']);

        return $us;
    }
    public function get(User $becarios)
    {
        //
        //$coordinador = User::all();
        $becarios  = $becarios->first();
    }

    public function model(array $row)
    {

        $coordinador = User::where('us_banner_id', base64_encode($row['id']))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $num = $coordinador->count();

        ///////////COMPROBACION DE USUARIO EN TABLA USUARIOS
        if ($num == 0) {
            $register1 =
                User::create([
                    'us_uID' => Str::uuid(),
                    'us_banner_id' =>  base64_encode($row['id']),
                    'name' => Crypt::encryptString($row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']),
                    'ar_uID' => $this->areaS[$row['area']],
                    'deg_uID' => $this->grados[$row['grado']],
                    'email' => base64_encode($row['correo_institucional']),
                    'rol_uID' => 'a71bd1e8-bf2e-4a7b-89e4-47363d300f56',
                    'emailPersonal' => base64_encode($row['correo_alternativo']),
                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                    'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
                ]);

            $exist = $register1->us_uID;
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
                'rol' => 1,
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);
            $exist = $register1->us_uID;
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
                'rol' =>  1,
                'conv_uID' => $this->conv_uID ,
                'ar_uID' => $this->areaS[$row['area']],
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);

        }

    }

}
