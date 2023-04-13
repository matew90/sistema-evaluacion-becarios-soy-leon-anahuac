<?php

namespace App\Http\Controllers\scholarshipEvaluation\administrator;

use App\Exports\assigmentsExport;
use App\Exports\BecariosExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\FunctionController;
use App\Models\assigments;
use App\Models\convocations;
use App\Models\evaluations;
use App\Models\records;
use App\Models\temporal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ConvocatoriaController extends Controller
{
    public function remplaceBeca($porcentaje)
    {

        $vowels = array("b", "c", "d", "e");
        $vowels2 = array('5 a 25', '26 a 50', '56 a 75', '76 a 100');
        $beca = str_replace($vowels, $vowels2, $porcentaje);
        return $beca;
    }

    public function index(convocations $conv)
    {
        $convocatorias = convocations::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();


        $data = array("convocatorias" => $convocatorias);

        return response()->view('scholarshipEvaluation.convocations.show', $data, 200);
    }

    public function asignaciones(convocations $conv)
    {

        $resultado = assigments::join("evaluations", "evaluations.assig_uID", "=", "assigments.assig_uID")
            ->select("*")
            ->where("evaluations.sta_uID", '023584f1-5547-429a-a131-3b3810d156c7')
            ->where('conv_uID', $conv->conv_uID)
            ->get();

        $data = [];
        foreach ($resultado as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->becario->us_banner_id),
                "name" => Crypt::decryptString($value->becario->name),
                "ar_uID" => $value->becario->area->ar_name,
                "us_banner_id1" => base64_decode($value->coordinador->us_banner_id),
                "name1" => Crypt::decryptString($value->coordinador->name),
                "ar_uID1" => $value->coordinador->area->ar_name,

                "options" => "<span class='btn btn-outline-purple waves-effect waves-light mr-2' onclick='delete_assigment(id)' id='$value->assig_uID'><i class=' text-aligns-center mdi mdi-trash-can mdi-24px ' style='color:#9267DC;'></i></span><span class='btn btn-outline-purple waves-effect waves-light' onclick='show_evaluation(id)'  id='$value->assig_uID'><i class='mdi dripicons-preview mdi-24px ' style='color: #9267DC;'></i></span>",
            ];
        }
        $response = array(
            "draw" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        return json_encode($response);
    }

    public function evaluaciones(convocations $conv, evaluations $assig)
    {

        $filtered = assigments::where('conv_uID', $conv->conv_uID)->where('sta_uID', 'f567f85f-096c-4173-ac41-6b624d7024d4')->get();
        $data = [];
        foreach ($filtered as $key => $value) {
            # code...
            $data[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->becario->us_banner_id),
                "name" => Crypt::decryptString($value->becario->name),
                "ar_uID" => $value->becario->area->ar_name,
                "us_banner_id1" => base64_decode($value->coordinador->us_banner_id),
                "name1" => Crypt::decryptString($value->coordinador->name),
                "ar_uID1" => $value->coordinador->area->ar_name,
                "options2" => "<span class='btn btn-outline-purple waves-effect waves-light mr-2' onclick='evaluation(id)'  id='$value->assig_uID'><i class='mdi mdi-format-list-checks mdi-24px ' style='color:#7043c1'></i></span>",
            ];
        }
        $response = array(
            "draw" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        return json_encode($response);
    }

    public function create()
    {
        //
        return view('scholarshipEvaluation.convocations.create');
    }

    public function store(Request $request)
    {
        if (convocations::where('conv_name', 'LIKE', $request->nombre)->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->count() > 0) { #1

            $result = [
                'title' => "¡Aviso!",
                'type' => "error",
                'text' => "Existe una convocatoria registrada con el mismo nombre",
            ];
            return json_encode($result);
        } else {
            convocations::create([
                'conv_uID' => Str::uuid(),
                'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                'conv_name' => $request->nombre,
                'conv_period' => $request->periodo,
                'conv_email' => base64_encode($request->email),
                'conv_porcentage' => implode(",", $request->porcentage),
                'conv_comments' => $request->comentarios,
                'conv_end_date' => $request->fecha_fin,
                'conv_start_date' => $request->fecha_inicio,
                'created_by' => Auth::user()->us_uID,
                'updated_by' => Auth::user()->us_uID,
            ]);

            $result = [
                'title' => "Convocatoria registrada",
                'type' => "success",
                'text' => "La información ha sido registrada correctamente",
            ];
            return json_encode($result);
        }
    }

    public function delete_conv(convocations $conv)
    {
        $general = convocations::where('id', $conv->id)->update(['sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a']);
        return back()->with('success', 'Convocatoria eliminada correctamente');
    }

    public function show($conv)
    {
        $assig = assigments::all();
        $convocatorias = convocations::where('conv_uID', $conv)->first();
        $assigments = assigments::where('conv_uID', $conv)->first();

        $coordinadores = records::where('conv_uID', $conv)->where('rol', '>', 0)->get();
        $data_arr = [];
        //dd($coordinadores->toArray());
        /*  $coordinadores = User::where('rol_uID','a71bd1e8-bf2e-4a7b-89e4-47363d300f56')->get();*/
        foreach ($coordinadores as $key => $value) {
            $data_arr[] = [
                "id" => $value->id,
                "us_uID" => $value->user->us_uID,
                "us_banner_id" => base64_decode($value->user->us_banner_id),
                "us_name" => Crypt::decryptString($value->user->name),
                "ar_uID" => $value->user->area->ar_name,
            ];
            //dd($value->toArray());
        }


        return view('scholarshipEvaluation.convocations.details', ['coordinadores' => $data_arr], compact('convocatorias'), compact('assigments'));
    }

    public function edit(convocations $conv)
    {
        //
        $porcBeca['b'] = "5% a 25%";
        $porcBeca['c'] = "26% a 50%";
        $porcBeca['d'] = "51% a 75%";
        $porcBeca['e'] = "76% a 100%";
        //<dd($porcBeca);
        return view('scholarshipEvaluation.convocations.edit', compact('conv'), compact('porcBeca'));
    }

    public function update(Request $request, convocations $conv)
    {
        $conv->conv_name = $request->nombre;
        $conv->conv_period = $request->periodo;
        $conv->conv_email = base64_encode($request->email);
        $conv->conv_porcentage = implode(",", $request->porcentage);
        $conv->conv_comments = $request->comentarios;
        $conv->conv_end_date = $request->fecha_fin;
        $conv->conv_start_date = $request->fecha_inicio;

        $conv->save();

        return redirect()->route('evaluacion-becarios.convocatoria-becarios.index', $conv);
    }

    public function student(convocations $conv, assigments $assig)
    {
        $assig = $assig->select('us_uID')->get();
        $filtered = records::where('conv_uID', $conv->conv_uID)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->where('rol', 0)->whereNotIn('us_uID', $assig)->get();

        $data_arr = [];
        foreach ($filtered as $key => $value) {

            $data_arr[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->user->us_banner_id),
                "sta_uID" => $value->user->status->name,
                "name" => Crypt::decryptString($value->user->name),
                "ar_uID" => $value->user->area->ar_name,
                "options" => "<span id='" . $value->user->us_uID . "'><input id='asignar[]' value='" . $value->user->us_uID . "' name='asignar[]' type='checkbox'></span>",
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


    public function delete(Request $request)
    {
        $delete_beca = assigments::where('assig_uID', $request->assig_uID)->delete(['assig_uID' => $request->assig_uID]);
        $result = [
            'title' => "Becario eliminado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode($result);
    }



    public function asignar(Request $request)
    {

        $us_uID = $request->asignar;

        $select_coordinador = $request->select_coordinador;

        $conv_uID = $request->conv_uID;

        for ($i = 0; $i < count($us_uID); $i++) {
            assigments::create([
                'assig_uID' => Str::uuid(),
                'us_uID' => $request->asignar[$i],
                'coord_uID' => $select_coordinador,
                'conv_uID' => $conv_uID,
                'sta_uID' => 'f567f85f-096c-4173-ac41-6b624d7024d4',

            ]);
        }

        $result = [
            'title' => "Asignación exitosa",
            'type' => "success",
            'text' => "La información ha sido registrada correctamente",
        ];
        return json_encode($result);
    }



    public function evaluations($records, Request $request, records $record, evaluations $evaluacion)
    {
        //$records = records::first();
        $data = [];
        $asignados = assigments::where('assig_uID', $request->assig_uID)->get();

        foreach ($asignados as $key => $value) {
            # code...
            $data[] = [
                "assig_uID" => $value->assig_uID,
                "us_banner_id" => base64_decode($value->becario->us_banner_id),
                "name" => Crypt::decryptString($value->becario->name),
                "email" => base64_decode($value->becario->email),
                "ar_uID" => $value->becario->area->ar_name,
                "sch_type" => $value->record->sch_type,
                "sch_porcentage" => $value->record->sch_porcentage,
                "us_banner_id1" => base64_decode($value->coordinador->us_banner_id),
                "name1" => Crypt::decryptString($value->coordinador->name),
                "eval_Question1" => $value->evaluacion->eval_Question1,
                "eval_Question2" => $value->evaluacion->eval_Question2,
                "eval_Question3" => $value->evaluacion->eval_Question3,
                "eval_Question4" => $value->evaluacion->eval_Question4,
                "eval_Question5" => $value->evaluacion->eval_Question5,
                "eval_Question6" => $value->evaluacion->eval_Question6,
                "created_at" => $value->evaluacion->created_at,
                "updated_at" => $value->evaluacion->updated_at,
                "ar_uID1" => $value->coordinador->area->ar_name,

            ];
        }

        return view('scholarshipEvaluation.convocations.evaluations', compact('data'), compact('records'));
    }

    public function evaluations1($records, Request $request, records $record, evaluations $evaluacion)
    {
        //$records = records::first();

        $data = [];

        $asignados = assigments::where('assig_uID', $request->assig_uID)->get();

        foreach ($asignados as $key => $value) {
            # code...
            $data[] = [
                "assig_uID" => $value->assig_uID,
                "us_banner_id" => base64_decode($value->becario->us_banner_id),
                "name" => Crypt::decryptString($value->becario->name),
                "email" => base64_decode($value->becario->email),
                "ar_uID" => $value->becario->area->ar_name,
                "sch_type" => $value->record->sch_type,
                "sch_porcentage" => $value->record->sch_porcentage,
                "us_banner_id1" => base64_decode($value->coordinador->us_banner_id),
                "name1" => Crypt::decryptString($value->coordinador->name),
                "ar_uID1" => $value->coordinador->area->ar_name,
            ];
        }

        return view('scholarshipEvaluation.convocations.evaluations1', compact('data'), compact('records'));
    }

    public function store_evaluation(Request $request)
    {
        evaluations::create([
            'eval_uID' => Str::uuid(),
            'eval_Question1' =>  $request->question_1,
            'eval_Question2' => $request->question_2,
            'eval_Question3' => $request->question_3,
            'eval_Question4' => $request->question_4,
            'eval_Question5' => $request->question_5,
            'eval_Question6' => $request->question_6,
            'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
            'assig_uID' => $request->assig_uID,
            'created_by' => Auth::user()->us_uID,
        ]);
        $updated = assigments::where('assig_uID', $request->assig_uID)->update(['sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7s']);
        $result = [
            'title' => "Evaluación exitosa",
            'text' => "Se ha guardado la información de la evaluación",
            'type' => "success",
        ];
        return json_encode($result);
    }


    public function export(Request $request)
    {
        $asignados = assigments::join("records", "records.us_uID", "=", "assigments.us_uID")
        ->where('assigments.conv_uID', $request->conv_uID)
        ->where("assigments.sta_uID", '023584f1-5547-429a-a131-3b3810d156c7')
            ->get();
        //dd($asignados);
        $convocatoria = convocations::where('conv_uID', $request->conv_uID)->get();
        $data = [];
        foreach ($asignados as $key => $value) {
            # code...
            $data[] = [
                "id" => $value->id,
                "us_banner_id" => base64_decode($value->becario->us_banner_id),
                "name" => Crypt::decryptString($value->becario->name),
                "ar_uID" => $value->becario->area->ar_name,
                "email" => base64_decode($value->becario->email),
                "emailPersonal" => base64_decode($value->becario->emailPersonal),
                "sch_porcentage" => $value->sch_porcentage,
                "sch_type" => $value->sch_type,
                "us_banner_id1" => base64_decode($value->coordinador->us_banner_id),
                "name1" => Crypt::decryptString($value->coordinador->name),
                "email1" => base64_decode($value->coordinador->email),
                "emailPersonal1" => base64_decode($value->coordinador->emailPersonal),
                "ar_uID1" => $value->coordinador->area->ar_name,
                "sub_uID1" => ($value->coordinador->area->sub_name != "" ? $value->coordinador->area->sub_name : ''),
                "emailPersonal1" => base64_decode($value->coordinador->emailPersonal),
            ];
        }
        foreach ($convocatoria as $key_conv => $value_conv) {
            $vowels = array("b", "c", "d", "e");
            $vowels2 = array('5 a 25', '26 a 50', '56 a 75', '76 a 100');
            $beca = str_replace($vowels, $vowels2, $value_conv->conv_porcentage);

            $data_conv[] = [
                "conv_period" => $value_conv->conv_period,
                "conv_name" => $value_conv->conv_name,
                "conv_email" => $value_conv->conv_email,
                "conv_start_date" => $value_conv->conv_start_date,
                "conv_end_date" => $value_conv->conv_end_date,
                "conv_porcentage" => $beca,
                "conv_comments" => $value_conv->conv_comments,

            ];
        }
        return Excel::download(
            new assigmentsExport($data, $data_conv),
            'AsignacionesBecarios.xlsx'
        );
    }
}
