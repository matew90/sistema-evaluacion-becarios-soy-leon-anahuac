<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservaEspacios\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\general\Status;
use App\Models\general\Spaces;
use App\Models\general\Reservation;
use App\Models\general\Relation;
use App\Models\general\Inventory;
use Illuminate\Support\Facades\Crypt;
use App\Models\general\Area;
use Carbon\Carbon;
use Auth;
use Log;

class DiaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	 public function __construct()
     {
		 $this->sendMail = (new MailController);

     }
    public function index(Request $request)
    {

    }


	public function show(Request $request)
    {
		$getSpaces = Spaces::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->orderBy('spa_name', 'asc')->get();
		$getInventories = Inventory::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
		$getUsers=User::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->where('camp_uID','31eec942-8945-4096-8815-b39e97f782c5')->where('rol_uID','!=','ef4c62a5-dabf-4ff7-9d19-a6d68c1040ad')->where('rol_uID','!=','2fdc25a3-5510-47f0-8a8d-86f18f9c415f')->where('rol_uID','!=','18ffb841-deab-4835-bc3a-3c06b7c57fff')->get();
		$getAreas=Area::where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->orderBy('ar_name', 'asc')->get();
		if($request->ajax())
    	{
    		$data = Reservation::whereDate('start', '>=', $request->start)
                       ->whereDate('end',  '<=', $request->end)
                       ->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')
                       ->get();
			foreach ($data as $key => $value) {
				 $result[] = [
                "res_uID" => $value->res_uID,
                "title" => $value->title,
                "start" => $value->start." ".$value->res_time_start,
                "end" => $value->end." ".$value->res_time_end,
				"color" => $value->spacesGet->spa_color,
				"spa_uID" => $value->spa_uID,
				"us_uID" => $value->us_uID,
				"ar_uID" => $value->user->ar_uID
            ];

			}
            return response()->json($result);
    	}
		//dd($request->start);
		 Log::info('Get Spaces and Reservation');
     return view('ReservaEspacios.day')->with('spaces',$getSpaces)->with('users' , $getUsers)->with('areas' , $getAreas);

    // } catch (\Exception $e) {
      Log::error('Get Spaces and Reservation "Line: 30. ReservaController."');
     return view('ReservaEspacios.day',['spaces' => $getSpaces],['inventories' => $getInventories]);

    // }
	}
	public function view(Request $request){
		$data = Reservation::where('res_uID', $request->res_uID)->get();
		foreach ($data as $key => $value){
						$dia =Carbon::createFromFormat( 'Y-m-d', $value->start )->format( 'd/M/Y' );
						$timeStart = Carbon::createFromFormat('H:i:s', $value->res_time_start)->format('H:i');
						$timeEnd = Carbon::createFromFormat('H:i:s', $value->res_time_end)->format('H:i');
			$result[] = [
                "title" => $value->title,
                "place" => $value->spacesGet->spa_name,
                "time" => $timeStart." - ".$timeEnd,
				"color" => $value->spacesGet->spa_color,
				"user" => Crypt::decryptString($value->user->name),
				"area" => $value->user->area->ar_name,
				"options" => ($value->us_uID==Auth::user()->us_uID?1:0),
				"res_uID" => $value->res_uID,
				"dia" => $dia,
				"start" => $value->start
            ];

		}
		return $result;
	}

	public function delete(Request $request){
		 Reservation::where( 'res_uID', $request->res_uID)->update( [ 'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a','updated_by'=>Auth::user()->us_uID] );

		Relation::where('res_uID',$request->res_uID)->update( [ 'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a'] );
		$array=array();
		$getReservation=Reservation::where( 'res_uID', $request->res_uID)->first();
		$sendmail = $this->sendMail->sendMail(4,$request->res_uID ,$getReservation->res_folio, $getReservation->start, $getReservation->end,$array);
					
		 $result = [
            'title' => "¡Aviso!",
            'text' => "Reserva cancelada correctamente",
            'type' => "success",
        ];
        return json_encode( $result );
	}
	public function store(Request $request){
		$getSpaces=Spaces::where( 'sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->get();
		$getReservation=Reservation::where( 'res_uID', $request->res_uID)->first();
		$number=$getReservation->spacesGet->spa_person_number;
		$getInventories = Inventory::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
				foreach ($getInventories as $key => $value){
		$getRelation = Relation::where('res_uID', $request->res_uID)->where('inv_uID', $value->inv_uID);
					if($getRelation->count()>0){
						$numberTotal=$getRelation->first();
						$total=$numberTotal->resinv_number;
					}else{
						$total=0;
					}
					$result[] = [
                "inv_uID" => $value->inv_uID,
                "inv_name" => $value->inv_name,
                "inv_number" => $value->inv_number,
                "total" => $total,
            ];
				}

         return view('ReservaEspacios.edit',['reservation' => $getReservation],['inventories' => $result])->with('number',$number)->with('spaces',$getSpaces)->with('relation',$getRelation);
	}

	public function edit(Request $request){
		$getSpaces=Spaces::where( 'sta_uID','023584f1-5547-429a-a131-3b3810d156c7')->get();
		$getReservation=Reservation::where( 'res_uID', $request->res_uID)->first();
		$number=$getReservation->spacesGet->spa_person_number;
		$getInventories = Inventory::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
				foreach ($getInventories as $key => $value){
		$getRelation = Relation::where('res_uID', $request->res_uID)->where('inv_uID', $value->inv_uID);
					if($getRelation->count()>0){
						$numberTotal=$getRelation->first();
						$total=$numberTotal->resinv_number;
					}else{
						$total=0;
					}
					$result[] = [
                "inv_uID" => $value->inv_uID,
                "inv_name" => $value->inv_name,
                "inv_number" => $value->inv_number,
                "total" => $total,
            ];
				}

         return view('ReservaEspacios.edit',['reservation' => $getReservation],['inventories' => $result])->with('number',$number)->with('spaces',$getSpaces)->with('relation',$getRelation);

	}

}
