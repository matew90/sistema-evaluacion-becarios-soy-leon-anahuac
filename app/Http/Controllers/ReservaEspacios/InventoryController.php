<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\general\Status;
use App\Models\general\Inventory;
use App\Models\general\Relation;
use App\Models\general\Area;
use App\Models\general\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Log;

class InventoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

		return view('ReservaEspacios.Inventory.index');
    }
	public function show(Request $request)
    {
		$getSpaceas = Inventory::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->get();

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
                "inv_uID" => $value->inv_uID,
                "sta_uID" => $statusColor,
                "inv_name" => $value->inv_name, 
                "inv_number" => $value->inv_number,
                "us_uID" => Crypt::decryptString($value->user->name),
                "ar_uID" => $value->user->area->ar_name.($value->user->area->ar_subname!=""?'/'.$value->user->area->ar_subname.'':''),
                //"ar_uID" => $value->area->ar_name.($value->area->ar_subname!=""?'/'.$value->area->ar_subname.'':''),
                "options" => "<span id='$value->inv_uID' class='view_details' onclick='view_details(id)'><i class='fas fa-edit fa-lg'></i></span> <span class='delete_space' onclick='delete_space(id)' id='$value->inv_uID'><i class='fas fa-trash-alt optionsClass fa-lg'></i></span>",
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
		$getUsers=User::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->where('camp_uID','31eec942-8945-4096-8815-b39e97f782c5')->where('rol_uID','!=','ef4c62a5-dabf-4ff7-9d19-a6d68c1040ad')->where('rol_uID','!=','2fdc25a3-5510-47f0-8a8d-86f18f9c415f')->where('rol_uID','!=','18ffb841-deab-4835-bc3a-3c06b7c57fff')->orderBy('name', 'asc')->get();
      return view('ReservaEspacios.Inventory.create',compact('getUsers'));
    }

	 public function store(Request $request)
    {

		 if(Inventory::where('inv_name', 'LIKE', $request->name)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe un mobiliario registrado con el mismo nombre",
        ];
       		return json_encode( $result );
		 }#1

		Inventory::create([
          'inv_uID' => Str::uuid(),
          'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
          'inv_name' => $request->name,
          'inv_number' => $request->number,
          'us_uID' => $request->user,
          'created_by' => Auth::user()->us_uID
        ]);

		  $result = [
            'title' =>"Registro agregado",
            'type' => "success",
            'text' => "",
        ];
        Log::info('Create mobiliario name: '.$request->name.' by: '.Auth::user()->us_uID);
        return json_encode( $result );


        Log::error('Create mobiliario name by: '.Auth::user()->us_uID." Line: 48. InventoryController.");
		 return json_encode( $result );
    }

	 public function delete(Request $request)
		{
		 if(Relation::where('inv_uID',$request->inv_uID)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe al menos una reserva con mobiliario solicitado",
        ];
       		return json_encode( $result );
		 }#1

		 $general = Inventory::where( 'inv_uID', $request->inv_uID)->update( [ 'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a','updated_by'=>Auth::user()->us_uID] );
		 $result = [ 
            'title' => "Mobiliario eliminado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode( $result );

		}

	 public function view( Request $request ) {
      $getInventory = Inventory::where('inv_uID', $request->inv_uID )->first();
		 $getUsers=User::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->where('camp_uID','31eec942-8945-4096-8815-b39e97f782c5')->where('rol_uID','a71bd1e8-bf2e-4a7b-89e4-47363d300f56')->get();
		 foreach ($getUsers as $key => $value) {
				 $data_arr[] = [
                "us_uID" => $value->us_uID,
                "name" => Crypt::decryptString($value->name),
            ];
		}

        $info = [
            'inv_uID' => $getInventory->inv_uID,
            'inv_name' => $getInventory->inv_name,
            'inv_number' => $getInventory->inv_number,
            'users' => $data_arr,
        ];

        $allInfo = array_merge( $info );
        return $allInfo;
    }

	public function edit( Request $request ) {
		 if(Inventory::where('inv_name', 'LIKE', $request->name)->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->count()>0){#1
			 $result = [
            'title' =>"¡Aviso!",
            'type' => "error",
            'text' => "Existe un mobiliario registrado con el mismo nombre",
        ];
       		return json_encode( $result );
		 }#1

		Inventory::where( 'inv_uID', $request->inv_uID )->update( [ 'inv_name' => $request->name, 'inv_number' => $request->number, 'us_uID' => $request->user,'updated_by'=>Auth::user()->us_uID]);
        $result = [
            'title' => "Mobiliario actualizado correctamente",
            'text' => "",
            'type' => "success",
        ];
        return json_encode( $result );
    }
}
