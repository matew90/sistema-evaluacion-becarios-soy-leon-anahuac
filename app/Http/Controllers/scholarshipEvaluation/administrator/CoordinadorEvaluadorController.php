<?php

namespace App\Http\Controllers\scholarshipEvaluation\administrator;

use App\Models\User;
use App\Models\areas;
use App\Models\roles;
use App\Models\degrees;
use App\Models\records;
use App\Models\temporal;
use App\Models\assigments;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use App\Models\convocations;
use Illuminate\Http\Request;
use App\Imports\EvaluadoresImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class CoordinadorEvaluadorController extends Controller
{


    public function index(User $coordinador)
    {

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
        return view('scholarshipEvaluation.coordinator.index', ['coordinador' => $coordinador]);
    }


    public function create(Request $request)
    {
        //
        $id_conv = convocations::where('conv_uID', $request->conv)->first();
        $area = areas::where('cat_uID', '')->get();

        $degre = degrees::all();
        $data = array("lista_areas" => $area, "lista_degrees" => $degre);
        return response()->view('scholarshipEvaluation.coordinator.create', $data, 200);
    }

    public function store(Request $request)
    {

        ////////////ENCRIPTAR ID GLOBAL CON BASE64_ENCODE()////////////

        $coordinador = User::where('us_banner_id', base64_encode($request->idGlobalTalentC))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');

        $num = $coordinador->count();

        ///////////COMPROBACION DE USUARIO EN TABLA USUARIOS
        if ($num == 0) {
            $register =
                User::create([
                    'us_uID' => Str::uuid(),
                    'us_banner_id' =>  base64_encode($request->idGlobalTalentC),
                    'name' => Crypt::encryptString($request->nombreC . " " . $request->apellidoPatC . " " . $request->apellidoMatC),
                    'ar_uID' => $request->area_idC,
                    'deg_uID' => $request->grado_idC,
                    'email' => base64_encode($request->emailC),
                    'rol_uID' => $request->tipoUsuario_idC,
                    'emailPersonal' => base64_encode($request->email_personalC),
                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                    'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
                    'created_by' => Auth::user()->us_uID,
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
                'rol' => $request->tipoUsuario_idC,
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                'created_by' => Auth::user()->us_uID,
            ]);
            $exist = $register->us_uID;

        }else{
            $recR = $coordinador->first();
            $exist = $recR->us_uID;

        }
        //COMPROBACION DE USARIO EN TABLA RECORDS
        $rec = records::where('conv_uID', $request->conv)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
            $numR = $rec->count();
            if($numR == 0){
                records::create([
                    'rec_uID'=>Str::uuid(),
                    'us_uID'=> $exist,
                    'rol'=>  $request->tipoUsuario_idC,
                    'conv_uID'=> $request->conv_uIDC,
                    'ar_uID'=> $request->area_idC,
                    'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7',
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
            'text' => "Existe un Coordinador/Evaluador registrado con el mismo Id Global Talent",
        ];
        return json_encode($result);
    }
    public function evaluador(Request $request)
    {

        ////////////ENCRIPTAR ID GLOBAL CON BASE64_ENCODE()////////////

        $coordinador = User::where('us_banner_id', base64_encode($request->idGlobalTalentE))->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');

        $num = $coordinador->count();

        ///////////COMPROBACION DE USUARIO EN TABLA USUARIOS
        if ($num == 0) {
            $register =
                User::create([
                    'us_uID' => Str::uuid(),
                    'us_banner_id' =>  base64_encode($request->idGlobalTalentE),
                    'name' => Crypt::encryptString($request->nombreE . " " . $request->apellidoPatE . " " . $request->apellidoMatE),
                    'ar_uID' => $request->area_idE,
                    'deg_uID' => $request->grado_idE,
                    'email' => base64_encode($request->emailE),
                    'rol_uID' => $request->tipoUsuario_idE,
                    'emailPersonal' => base64_encode($request->email_personalE),
                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                    'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',
                    'created_by' => Auth::user()->us_uID,
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
                'rol' => $request->tipoUsuario_idE,
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                'created_by' => Auth::user()->us_uID,
            ]);
            $exist = $register->us_uID;

        }else{
            $recR = $coordinador->first();
            $exist = $recR->us_uID;

        }
        //COMPROBACION DE USARIO EN TABLA RECORDS
        $rec = records::where('conv_uID', $request->conv)->where('us_uID', $exist)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7');
            $numR = $rec->count();
            if($numR == 0){
                records::create([
                    'rec_uID'=>Str::uuid(),
                    'us_uID'=> $exist,
                    'rol'=>  $request->tipoUsuario_idE,
                    'conv_uID'=> $request->conv_uIDC,
                    'ar_uID'=> $request->area_idE,
                    'sta_uID'=> '023584f1-5547-429a-a131-3b3810d156c7',
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
            'text' => "Existe un Coordinador/Evaluador registrado con el mismo Id Global Talent",
        ];
        return json_encode($result);
    }


    public function show(Request $request)
    {
        $convocatorias = convocations::where('conv_uID', $request->conv)->first();
        //Función para obtener a los usuarios en la tabla coordinadores del modulo coordinadores
        //$getCoordinators = records::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where('rol', '>', 0)->get();
        $coordinadores = records::where('conv_uID', $request->conv)->where('rol', '>', 0)->get();

        foreach ($coordinadores as $key => $value) {
            if ($value->rol == 2) {
                $rol_name = 'Coordinador';
            } else {
                $rol_name = 'Evaluador';
            }

            $data_arr[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->user->us_banner_id),
                "sta_uID" => $value->user->status->name,
                "name" => Crypt::decryptString($value->user->name),
                "ar_uID" => $value->user->area->ar_name,
                "rol_uID" => $rol_name,
                "options" => "<span id='$value->us_uID' class='update_coordinator' onclick='update_coordinator(id), coordinador'  ><i class='mdi mdi-circle-edit-outline mdi-24px' style='color:#7043c1'></i></span> <span class='delete_coordinator' onclick='delete_coordinator(id)' id='$value->us_uID'><i class='mdi mdi-trash-can mdi-24px ' style='color:#7043c1'></i></span>",
            ];
        }
        $response = array(
            "draw" => 1,
            "iTotalRecords" => count($data_arr),
            "iTotalDisplayRecords" => count($data_arr),
            "aaData" => $data_arr
        );
        return json_encode($response);
    }

    public function student(Request $request)
    {

        //
        $getCoordinators = User::where('rol_uID', '96hub971-derf-4865-ba09-3c0wb7c57jff')->get();

        foreach ($getCoordinators as $key => $value) {


            $data_arr[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->us_banner_id),
                "name" => Crypt::decryptString($value->name),
                "ar_uID" => $value->area->ar_name,
                "options" => "",
            ];
        }
        $response = array(
            "draw" => 1,
            "iTotalRecords" => count($data_arr),
            "iTotalDisplayRecords" => count($data_arr),
            "aaData" => $data_arr
        );
        return json_encode($response);
    }

    public function delete($coord_uID, $conv)
    {
        $hasUsersConv =  assigments::where('conv_uID', $conv)->where("coord_uID", $coord_uID)->count();

        if($hasUsersConv > 0){#1
            $result = [
                'title' =>"¡Aviso!",
                'type' => "error",
                'text' => "No se puede eliminar al Coordinador/Evaluador, porque tiene becarios asignados.",
            ];
            return json_encode( $result );
        }
        $general = temporal::where('us_uID', $coord_uID)->update(['sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a']);
        $general = records::where('us_uID', $coord_uID)->update(['sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a']);
        $result = [
            'title' => "Coordinador eliminado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode($result);
    }


    public function edit($user, areas $area, degrees $degrees, records $record, $conv)
    {

        $user=User::where('us_uID', $user)->first();

        $area = areas::where('cat_uID', '')->get();
        $degre = degrees::all();
        $convocatoria = $conv;
        $data = array("lista_areas" => $area, "lista_degrees" => $degre);


        return view('scholarshipEvaluation.coordinator.update', compact('user', 'convocatoria'), $data, 200);
    }


    public function update(Request $request, User $user, $conv)
    {
        $request->merge(["id_siau_encode"=>base64_encode($request->id_SIU)]);
        $request->merge(["email_encode"=>base64_encode($request->email)]);
        $validated = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100',
            'area_id' => 'required|exists:areas,ar_uID',
            'grado_id' => 'required|exists:degrees,deg_uID',
            "email" => "required|email",
            "email_personal" => "required|email",
            "email_encode" => "unique:users,email,$user->id",
            "tipoUsuario_id" => "required|in:2,3"
        ],[
            'nombre.required' => 'El nombre es un dato obligatorio',
            'nombre.string' => 'El nombre es un dato obligatorio',
            'nombre.min' => 'El nombre debe contener al menos 3 dígitos',
            'nombre.max' => 'El nombre no puede pasar los 100 digitos',
            'area_id.required' => 'La carrera es un dato obligatorio',
            'area_id.exists' => 'La carrera seleccionada no es válida',
            'grado_id.exists' => 'El grado seleccionada no es válida',
            'grado_id.required' => 'El grado es un dato obligatorio',
            'email.required' => 'El correo institucional es obligatorio',
            'email.email' => 'El correo insitucional no es válido',
            'email_personal.email' => 'El correo personal no es válido',
            'email_personal.required' => 'El correo personal es obligatorio',
            'email_encode.unique' => 'El correo institucional que está ingresando ya ha sido tomado',
            'tipoUsuario_id.required' => "El tipo de usuario es obligatorio",
            "tipoUsuario_id.in" => 'El tipo de usuario no es válido'
        ]);

        if($validated->fails()){

            $result = [
                'title' => "¡Aviso!",
                'type' => "warning",
                'text' => $validated->errors()->first(),
            ];
            return json_encode($result);
        }

        if($user->us_banner_id !=  base64_encode($request->idGlobalTalent)){

            $result = [
                'title' => "¡Aviso!",
                'type' => "warning",
                'text' => "El Id global talent no es modificable",
            ];
            return json_encode($result);
        }

        //
        $record = records::where("conv_uID", $conv)->where("rol", "!=", User::ROL_BECARIO)->where("sta_uID", records::UID_STATUS_ACTIVE)->where("us_uID", $user->us_uID)->first();
        if($record){
            $record->ar_uID =  $request->area_id;
            $user = $record->user;
            if($user){
                $user->update([
                    'name'=> Crypt::encryptString($request->nombre),
                    'ar_uID'=> $request->area_id,
                    'deg_uID'=> $request->grado_id,
                    'email' =>base64_encode($request->email),
                    'emailPersonal' =>base64_encode($request->email_personal),
                    'rol_uID' => $request->tipoUsuario_id
                ]);
            }
            $record->save();
        }else{
            $result = [
                'title' => "Coordinador/evaluador no encontrado",
                'text' => "Registro no encontrado, favor de recargar",
                'type' => "success",
            ];
            return json_encode($result);
        }

        $result = [
            'title' => "Coordinador/evaluador actualizado correctamente",
            'text' => "Registro actualizado",
            'type' => "success",
        ];
        return json_encode($result);

    }


    public function destroy($id)
    {
        //
    }


    public function import(Request $request)
    {

        $conv_uID=$request->conv_uID;

        if($request->hasFile('import_Coordinators')){
            $path1 = $request->file('import_Coordinators')->store('temp');
            $path=storage_path('app').'/'.$path1;
            $data = \Excel::import(new EvaluadoresImport($conv_uID),$path);
         }
         return back()->with('success', 'Coordinadores importados correctamente');


    }

}
