<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\general\Status;
use App\Models\general\Spaces;
use App\Models\general\Reservation;
use App\Models\general\Inventory;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Auth;
use Log;

class MesController extends Controller
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
		if($request->ajax())
    	{
    		$data = Reservation::whereDate('start', '>=', $request->start)
                       ->whereDate('end',  '<=', $request->end)
                       ->where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')
					   ->groupByRaw('start')
                       ->get();
			foreach ($data as $key => $value) {
				 $result[] = [
               // "title" => $value->spacesGet->spa_name,
                "title" => 'Ver reservas',
                "start" => $value->start,
                "end" => $value->end,
				"color" => '#673BB7',
				"space" => $value->spa_uID
            ];

			}
            return response()->json($result);
    	}
		//dd($request->start);
		 Log::info('Get Spaces and Reservation');
     return view('ReservaEspacios.month',['spaces' => $getSpaces],['inventories' => $getInventories]);

    // } catch (\Exception $e) {
      Log::error('Get Spaces and Reservation "Line: 30. ReservaController."');
     return view('ReservaEspacios.month',['spaces' => $getSpaces],['inventories' => $getInventories]);

    // }
	}

	public function view(Request $request){

		$data = Reservation::whereDate('start', '=', $request->start)->get();
		foreach ($data as $key => $value){

						$timeStart = Carbon::createFromFormat('H:i:s', $value->res_time_start)->format('H:i');
						$timeEnd = Carbon::createFromFormat('H:i:s', $value->res_time_end)->format('H:i');
    $output []= [
				"title" => $value->title,
                "place" => $value->spacesGet->spa_name,
                "timeStart" => $timeStart,
				"color" => $value->spacesGet->spa_color,
				"timeEnd" => $timeEnd,
				"options" => ($value->us_uID==Auth::user()->us_uID?1:0)
		];
   }

		return $output;
	}

}
