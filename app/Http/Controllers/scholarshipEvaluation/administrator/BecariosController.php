<?php

namespace App\Http\Controllers\scholarshipEvaluation\administrator;

use App\Models\User;
use App\Models\areas;
use App\Models\degrees;
use App\Models\records;
use App\Models\temporal;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use App\Models\convocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class BecariosController extends Controller
{

    public function index(User $coordinador)
    {
        //
        $coordinador = User::all();
        foreach ($coordinador as $key => $value) {
            $data_arr[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->us_banner_id),
                "name" => Crypt::decryptString($value->name),
                "ar_uID" => base64_decode($value->area->ar_name),
                "options"
            ];
        }

        return view('scholarshipEvaluation.scholarship.show', ['coordinador' => $coordinador]);
    }


    public function create(Request $request)
    {
        //dd($request->conv);

        $id_conv = convocations::where('conv_uID', $request->conv)->first();

        $area = areas::where('cat_uID', '')->get();
        $carrera = areas::where('cat_uID', 'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4')->orWhere('ar_uID', 'ar_parent_uID')->get();
        $degre = degrees::all();
        $data = array("lista_areas" => $area, "lista_carreras" => $carrera, "lista_degrees" => $degre, "id_conv" => $id_conv);


        return response()->view('scholarshipEvaluation.scholarship.create', $data, 200, compact('id_conv'));
    }



    public function store(Request $request, convocations $conv)
    {

        $becario = User::where('us_banner_id', base64_encode($request->id_SIUB))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $num = $becario->count();
        if ($num == 0) {
            $register =
                User::create([
                    'us_uID' => Str::uuid(),
                    'us_banner_id' =>  base64_encode($request->id_SIUB),
                    'name' => Crypt::encryptString($request->nombreB . " " . $request->apellidoPatB . " " . $request->apellidoMatB),
                    'ar_uID' => $request->area_idB,
                    'email' => base64_encode($request->email_InstitucionalB),
                    'rol_uID' => '18ffb841-deab-4835-bc3a-3c06b7c57fff',
                    'emailPersonal' => base64_encode($request->email_personalB),
                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                    'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
                    'created_by' => Auth::user()->us_uID,
                ]);
            $exist = $register->us_uID;
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
                'created_by' => Auth::user()->us_uID,
            ]);
            $exist = $register->us_uID;
        } else {
            $recR = $becario->first();
            $exist = $recR->us_uID;
        }
        //COMPROBACION DE USUARIO EN TABLA RECORDS
        $rec = records::where('conv_uID', $request->conv)->where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
        $numR = $rec->count();
        if ($numR == 0) {
            records::create([
                'rec_uID' => Str::uuid(),
                'sch_type' => $request->tipo_becaB,
                'sch_porcentage' => $request->porcentage_becaB,
                'us_uID' => $exist,
                'rol' =>  0,
                'conv_uID' => $request->conv_uID,
                'ar_uID' => $request->area_idB,
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            ]);
            $result = [
                'title' => "¡Aviso!",
                'type' => "success",
                'text' => "Registro guardado exitosamente",
            ];
            return json_encode($result);
        }
        $result = [
            'title' => "¡Aviso!",
            'type' => "warning",
            'text' => "Existe un Becario registrado con el mismo Id SIU",
        ];
        return json_encode($result);
    }


    public function show(Request $request, $convocatoria)
    {

        //Función para obtener a los usuarios en la tabla becarios del modulo becarios
        $statuseTemporal = temporal::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
        $getScholarships = records::where('conv_uID', $request->conv)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where('rol', 0)->get();
        $coordinadores = records::where('conv_uID', $request->conv)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where('rol', '>', 0)->get();
        $data_arr = [];
        $data_coo = [];
        //$getCoordinators = records::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where('conv_uID', $request->conv)->where('rol', ">", 1)->get();
        foreach ($statuseTemporal as $key => $value) {
            $status = $value->sta_uID;
        }
        if ($status == '023584f1-5547-429a-a131-3b3810d156c7') {
            foreach ($getScholarships as $key => $value) {
                switch ($value->rol) {
                    case 0:
                        $rol_name = 'Becario';
                        break;
                }
                # code...
                $data_arr[] = [
                    "id" => $value->id,
                    "us_uID" => $value->us_uID,
                    "us_banner_id" => base64_decode($value->user->us_banner_id),
                    "email" => base64_decode($value->user->email),
                    "sta_uID" => $value->user->status->name,
                    "name" => Crypt::decryptString($value->user->name),
                    "sch_type" => $value->sch_type,
                    "sch_porcentage" => $value->sch_porcentage,
                    "ar_uID" => $value->area->ar_name,
                    "rol_uID" => $rol_name,
                    "options2" => "<span id='$value->us_uID' class='update_becario' onclick='update_becario(id)''><i class='mdi mdi-circle-edit-outline mdi-24px' style='color:#7043c1'></i></span> <span class='delete_becario' onclick='delete_becario(id)' id='$value->us_uID'><i class='mdi mdi-trash-can mdi-24px ' style='color:#7043c1'></i></span>",
                ];
            }
            foreach ($coordinadores as $key => $value) {
                switch ($value->rol) {
                    case 2:
                        $rol_name = 'Coordinador';
                        break;
                    case 1:
                        $rol_name = 'Evaluador';
                        break;
                }
                # code...
                $data_coo[] = [
                    "id" => $value->id,
                    "us_uID" => $value->us_uID,
                    "us_banner_id" => base64_decode($value->user->us_banner_id),
                    "email" => base64_decode($value->user->email),
                    "sta_uID" => $value->user->status->name,
                    "name" => Crypt::decryptString($value->user->name),
                    "ar_uID" => $value->area->ar_name,
                    "rol_uID" => $rol_name,
                    "options2" => "<span id='$value->us_uID' class='btn btn-outline-purple waves-effect waves-light mr-2' onclick='update_becario(id)''><i class='mdi mdi-circle-edit-outline mdi-24px' style='color:#7043c1'></i></span> <span class='btn btn-outline-purple waves-effect waves-light' onclick='delete_becario(id)' id='$value->us_uID'><i class='mdi mdi-trash-can mdi-24px ' style='color:#7043c1'></i></span>",
                ];
            }

            return view('scholarshipEvaluation.scholarship.show', compact('data_arr', 'data_coo', 'convocatoria'));
        }
    }



    public function edit($user, areas $area, degrees $degrees, records $record, $conv)
    {
        $user = User::where('us_uID', $user)->first();

        //dd($user); */
        $area = areas::where('cat_uID', 'e8597dc7-0d81-4ca5-a415-6dc2b9df52f4')->orWhere('ar_uID', 'ar_parent_uID')->get();
        $degre = degrees::all();
        $convocatoria = $conv;
        $data = array("lista_areas" => $area, "lista_degrees" => $degre);
        //return view('scholarshipEvaluation.scholarship.update', compact('user'), $data, 200);
        return view('scholarshipEvaluation.scholarship.update', compact('user', 'convocatoria'), $data, 200);
    }


    public function update(Request $request, User $user, $conv)
    {
        $request->merge(["id_siau_encode" => base64_encode($request->id_SIU)]);
        $request->merge(["email_encode" => base64_encode($request->email_Institucional)]);
        $validated = Validator::make($request->all(), [
            'id_siau_encode' => "required|unique:users,us_banner_id,$user->id",
            'nombre' => 'required|string|min:3|max:100',
            'area_id' => 'required|exists:areas,ar_uID',
            "email_Institucional" => "required|email",
            "email_personal" => "required|email",
            "email_encode" => "unique:users,email,$user->id",
            "tipo_beca" => "required|in:Artística,Deportiva,Excelencia,Académica,SEP"
        ], [
            'id_siau_encode.unique' => 'Ya existe un usuario con ese id SIU',
            'id_siau_encode.required' => 'El id SIU es obligatorio',
            'nombre.required' => 'El nombre es un dato obligatorio',
            'nombre.string' => 'El nombre es un dato obligatorio',
            'nombre.min' => 'El nombre debe contener al menos 3 dígitos',
            'nombre.max' => 'El nombre no puede pasar los 100 digitos',
            'area_id.required' => 'La carrera es un dato obligatorio',
            'area_id.exists' => 'La carrera seleccionada no es válida',
            'email_Institucional.required' => 'El correo institucional es obligatorio',
            'email_Institucional.email' => 'El correo insitucional no es válido',
            'email_personal.email' => 'El correo personal no es válido',
            'email_personal.required' => 'El correo personal es obligatorio',
            'email_encode.unique' => 'El correo institucional que está ingresando ya ha sido tomado',
            'tipo_beca.required' => "El tipo de beca es obligatorio",
            "tipo_beca.in" => 'El tipo de beca no es válido(Artística,Deportiva,Excelencia,Académica,SEP)'
        ]);

        if ($validated->fails()) {

            $result = [
                'title' => "¡Aviso!",
                'type' => "warning",
                'text' => $validated->errors()->first(),
            ];
            return json_encode($result);
        }
        if ($user->us_banner_id != base64_encode($request->id_SIU)) {

            $result = [
                'title' => "¡Aviso!",
                'type' => "warning",
                'text' => "El Id SIU no es modificable",
            ];
            return json_encode($result);
        }

        $user->name = Crypt::encryptString($request->nombre);

        $record = records::where("conv_uID", $conv)->where("sta_uID", records::UID_STATUS_ACTIVE)->where("us_uID", $user->us_uID)->first();
        if ($record) {
            $record->ar_uID =  $request->area_id;
            $record->sch_type =  $request->tipo_beca;
            $record->sch_porcentage = $request->porcentaje_beca;
            $record->save();
        }

        $user->email = base64_encode($request->email_Institucional);
        $user->emailPersonal = base64_encode($request->email_personal);
        $user->save();

        $result = [
            'title' => "¡Aviso!",
            'type' => "success",
            'text' => "Registro modificado exitosamente",
        ];
        return response()->json($result, 200);
    }

    public function import(Request $request)
    {
        $conv_uID = $request->conv_uID;

        if ($request->hasFile('import_Scholarship')) {
            $path1 = $request->file('import_Scholarship')->store('temp');
            $path = storage_path('app') . '/' . $path1;
            $data = \Excel::import(new UsersImport($conv_uID), $path);
        }
        return back()->with('success', 'Becarios importados correctamente');
    }

    public function mostrar()
    {
        $user = User::all();
        return view('scholarshipEvaluation.coordinador.index', ['convocatorias' => $user]);
    }

    public function delete(Request $request, $us_uID, $conv)
    {
        $general = temporal::where('us_uID', $us_uID)->update(['sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a']);
        $general2 = records::where('us_uID', $us_uID)->where("conv_uID", $conv)->update(['sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a']);
        $result = [
            'title' => "Becario eliminado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode($result);
    }
}
