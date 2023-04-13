<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\general\Status;
use App\Models\general\Spaces;
use App\Models\general\Reservation;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Log;

class SpacesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

		return view('ReservaEspacios.Spaces.index');
    }
	public function show(Request $request)
    {
		$getSpaceas = Spaces::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->get();

		foreach ($getSpaceas as $key => $value) {

          switch ($value->status->name) {
                    case 'Activo':
                      $statusColor="<span class='alert-success pt-1 pb-1 pr-5 pl-5'>Activo</span>";
                      break;
                    case 'Inactivo':
                      $statusColor="<span class='alert-warning pt-1 pb-1 pr-5 pl-5'>Inactivo</span>";
                      break;
			}
				 $data_arr[] = [
                "spa_uID" => $value->spa_uID,
                "sta_uID" => $statusColor,
                "spa_name" => $value->spa_name,
                "spa_person_number" => $value->spa_person_number,
                "spa_color" => "<span class='pt-1 pb-1 pr-5 pl-5' style='background:$value->spa_color'></span>",
                "options" => "<span id='$value->spa_uID' class='view_details' onclick='view_details(id)'><i class='fas fa-edit fa-lg'></i></span> <span class='delete_space' onclick='delete_space(id)' id='$value->spa_uID'><i class='fas fa-trash-alt optionsClass fa-lg'></i></span>",
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


	public function create()
    {
      $getStatus = Status::all();

      return view('ReservaEspacios.Spaces.create', compact('getStatus'));
    }

	 public function store(Request $request)
    {

		 if(Spaces::where('spa_name', 'LIKE', $request->name)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe un espacio registrado con el mismo nombre",
        ];
       		return json_encode( $result );
		 }#1

		Spaces::create([
          'spa_uID' => Str::uuid(),
          'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
          'spa_name' => $request->name,
          'spa_person_number' => $request->number,
          'spa_color' => $request->color,
          'created_by' => Auth::user()->us_uID
        ]);

		  $result = [
            'title' =>"Registro agregado",
            'type' => "success",
            'text' => "",
        ];
        Log::info('Create espacio name: '.$request->name.' by: '.Auth::user()->us_uID);
        return json_encode( $result );


        Log::error('Create espacio name by: '.Auth::user()->us_uID." Line: 48. MSpacesController.");
		 return json_encode( $result );
    }

	 public function delete(Request $request)
		{
		 if(Reservation::where('spa_uID', $request->spa_uID)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe al menos una reserva en este espacio",
        ];
       		return json_encode( $result );
		 }#1

		 $general = Spaces::where( 'spa_uID', $request->spa_uID)->update( [ 'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a','updated_by'=>Auth::user()->us_uID] );
		 $result = [
            'title' => "Espacio eliminado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode( $result );

		}

	 public function view( Request $request ) {
      $getSpaces = Spaces::where('spa_uID', $request->spa_uID )->first();
        $info = [
            'spa_uID' => $getSpaces->spa_uID,
            'spa_name' => $getSpaces->spa_name,
            'spa_person_number' => $getSpaces->spa_person_number,
            'spa_color' => $getSpaces->spa_color,
        ];

        $allInfo = array_merge( $info );
        return $allInfo;
    }

	public function edit( Request $request ) {
		 if(Spaces::where('spa_name', 'LIKE', $request->name)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe un espacio registrado con el mismo nombre",
        ];
       		return json_encode( $result );
		 }#1

		Spaces::where( 'spa_uID', $request->spa_uID )->update( [ 'spa_name' => $request->name, 'spa_color' => $request->color, 'spa_person_number' => $request->number,'updated_by'=>Auth::user()->us_uID]);
        $result = [
            'title' => "Espacio actualizado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode( $result );
    }
}
