<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\General\Status;
use App\Models\General\Spaces;
use App\Models\General\Reservation;
use App\Models\General\Inventory;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Log;

class ReservaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
    }

	
	public function show(Request $request)
    {	
		$getSpaces = Spaces::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
		$getInventories = Inventory::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
		/*if($request->ajax())
    	{
    		$data = Reservation::whereDate('start', '>=', $request->start)
                       ->whereDate('end',  '<=', $request->end)
                       ->get();
			foreach ($data as $key => $value) {
				 $result[] = [
                "id" => $value->id,
                "title" => $value->title,
                "start" => $value->start." ".$value->res_time_start,
                "end" => $value->end." ".$value->res_time_end,
				"color" => $value->spacesGet->spa_color
            ];

			}
            return response()->json($result);
    	}
		*/
		if($request->ajax())
    	{
			
		$data = Reservation::whereDate('start', '>=', $request->start)
                       ->whereDate('end',  '<=', $request->end)
					   ->groupByRaw('start, spa_uID')
                       ->get();
			foreach ($data as $key => $value) {
				 $result[] = [
                "title" => $value->spacesGet->spa_name,
                "start" => $value->start." ".$value->res_time_start,
                "end" => $value->end." ".$value->res_time_start,
				"color" => $value->spacesGet->spa_color,
				"space" => $value->spa_uID
            ];
				
			}
            return response()->json($result);
    	}
		 Log::info('Get Spaces and Reservation');
     return view('ReservaEspacios.mostrar',['spaces' => $getSpaces],['inventories' => $getInventories]);

    // } catch (\Exception $e) {
      Log::error('Get Spaces and Reservation "Line: 30. ReservaController."');
     return view('ReservaEspacios.mostrar',['spaces' => $getSpaces],['inventories' => $getInventories]);

    // }
	}
	
	public function view(Request $request){
		$data = Reservation::whereDate('start', '=', $request->start)->get();
		foreach ($data as $key => $value){
			$result[] = [
                "title" => $value->title,
                "place" => $value->spacesGet->spa_name,
                "time" => $value->res_time_start." - ".$value->res_time_end,
				"color" => $value->spacesGet->spa_color,
				"user" => Crypt::decryptString($value->user->name),
				"area" => $value->user->area->ar_name,
				"options" => ($value->user->us_uID==Auth::user()->us_uID?1:0)
            ];
			
		}
		/*$data = Reservation::where('id', $request->id)->get();
		foreach ($data as $key => $value){
			$result[] = [
                "title" => $value->title,
                "place" => $value->spacesGet->spa_name,
                "time" => $value->res_time_start." - ".$value->res_time_end,
				"color" => $value->spacesGet->spa_color,
				"user" => Crypt::decryptString($value->user->name),
				"area" => $value->user->area->ar_name,
				"options" => ($value->user->us_uID==Auth::user()->us_uID?1:0)
            ];
			
		}*/
		return $request->start;
	}
	
	public function preview(Request $request)
    {
		//////////////OBTENEMOS NOMBRE DEL LUGAR//////////////
		$getSpaces = Spaces::where('spa_uID', $request->place)->first();
		
		//////////////RECORREMOS ARRAY PARA INSERTAR RESERVAS//////////////
		for ( $i = $request->dateStart; $i <= $request->dateEnd; $i = date( "Y-m-d", strtotime( $i . "+ 1 days" ) ) ) {#start for
			//////////////VALIDACIÓN DE RESERVAS EXISTENTES//////////////
			
			$reservation = Reservation::whereDate('start', '=', $i)
                       ->whereDate('end',  '=', $i)
					   ->whereTime('res_time_start', '>=', $request->timeStart.":00")
					   ->whereTime('res_time_end', '<=', $request->timeEnd.":00")
					   ->where('spa_uID', '=', $request->place);
					   $num=$reservation->count();
			if($num>0){#1
				$status="danger";
				$textStatus="No disponible";
			}else{#1
			$status="success";
			$textStatus="Disponible";
			}#1
			
			////////////////////DECLARAMOS ARRAY////////////////////////
			$infoInmob = array();
			////////////////////RECORREMOS  ARRAY DE INMOBILIARIO////////////////////////
			foreach ($request->inmob as $key => $valueInmob) {#1
			foreach ($valueInmob as $valueInmob2) {#2
				
						$getInvName = Inventory::where('inv_uID', $key)->first();
				////////////////////DECLARAMOS ARRAY////////////////////////
				if($valueInmob2 > 0){#3
					$getReservation=$reservation->where('resinv',1);
					if($getReservation->count()>0){
						foreach ($getReservation->get() as $keyRes => $valueRes) {
						$consult=Relation::where('res_uID',$valueRes->res_uID)->where('inv_uID',$key);
						$total=$consult->sum('resinv_number');
						$availability=$getInvName->inv_number-$total;
							
							///////////////////DECLARACIÓN DE OPCIONES A MOSTRAR EN TOTAL DE INVENTARIO /////////////////////////
					$infoInmob[]=[
						'name'=>$getInvName->inv_name,
						'number'=>($total>=$getInvName->inv_number || $total == 0?$valueInmob2:$availability)
						];
						}
					}else{
						$infoInmob[]=[
						'name'=>$getInvName->inv_name,
						'number'=>($valueInmob2>$getInvName->inv_number?$getInvName->inv_number:$valueInmob2)
						];
					}
				}#3
			}#2
		}#1
			
			$generalInfo[]=[
        'title' => $request->name,
        'start' => $i,
        'end' => $i,
        'res_time_start' => $request->timeStart,
        'res_time_end' => $request->timeEnd,
        'place' => $getSpaces->spa_name,
        'color' => $getSpaces->spa_color,
        'status' => $status,
        'textStatus' => $textStatus,
        'inmob' => $infoInmob,
				
      ];
		}#end for
		
        return $generalInfo;
		
    }
	
}
