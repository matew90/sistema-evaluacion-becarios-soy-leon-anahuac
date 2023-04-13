<?php

namespace App\Imports;

use App\Models\areas;
use App\Models\records;
use App\Models\temporal;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class UsersImport implements ToModel, WithHeadingRow
{
    use Importable, SkipsErrors;
    public $carreras;
    public $conv_uID;
    public function __construct($conv_uID)
    {
        $this->carreras = areas::pluck('ar_uID', 'ar_name');
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


        $becario = User::where('us_banner_id', base64_encode($row['id']))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $num = $becario->count();

        if ($num == 0) {
            $register2 = User::create([
                'us_uID' => Str::uuid(),
                'us_banner_id' => base64_encode($row['id']),
                'name' => Crypt::encryptString($row['nombre'] . ' ' . $row['apellido_paterno'] . ' ' . $row['apellido_materno']),
                'ar_uID' => $this->carreras[$row['carrera']],
                'email' => base64_encode($row['correo_institucional']),
                'emailPersonal' => base64_encode($row['correo_alternativo']),
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                'rol_uID' => '18ffb841-deab-4835-bc3a-3c06b7c57fff',
                'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
            ]);

            $exist = $register2->us_uID;
        } else {
            $temporalR = $becario->first();
            $exist = $temporalR->us_uID;
        }
        $temp = temporal::where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $numT = $temp->count();
        if ($numT == 0) {
            temporal::create([
                'temp_uID' => Str::uuid(),
                'us_uID' => $exist,
                'rol' => 0,
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);

            //$exist = $register2->us_uID;
        } else {
            $recR = $becario->first();
            $exist = $recR->us_uID;
        }
        $rec = records::where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where("conv_uID", $this->conv_uID);
        $numR = $rec->count();
        if ($numR == 0) {
            records::create([
                'rec_uID' => Str::uuid(),
                'sch_type' => $row['tipo_de_beca'],
                'sch_porcentage' => $row['beca_texto'],
                'us_uID' => $exist,
                'rol' => 0,
                'conv_uID' => $this->conv_uID,
                'ar_uID' =>$this->carreras[$row['carrera']],
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);
        }
    }


}
