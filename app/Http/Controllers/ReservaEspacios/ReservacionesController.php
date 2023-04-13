<?php

namespace App\Http\Controllers\ReservaEspacios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\general\Status;
use App\Models\general\Spaces;
use App\Models\general\Reservation;
use App\Models\general\Relation;
use App\Models\general\Inventory;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Auth;
use Log;

class ReservacionesController extends Controller {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        return view( 'ReservaEspacios.Reservaciones.index' );
    }

    public function show( Request $request ) {
        $getReservations = Reservation::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'resinv', 1 )->get();
        //dd($getReservations);
        foreach ( $getReservations as $key => $value ) {

            $getRelation = Relation::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'res_uID', $value->res_uID )->groupBy( 'res_uID' )->get();

            
            foreach ( $getRelation as $keyRelation => $valueRelation ) {
				//dd(Auth::user()->rol_uID);
				
				if ( Auth::user()->rol_uID == "36b0bee9-ea69-441d-a6c3-76ab7d8710a3" ) {
					
                $getInventory = Inventory::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'inv_uID', $valueRelation->inv_uID )->get();
                
        } else {
           $getInventory = Inventory::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'inv_uID', $valueRelation->inv_uID )->where( 'us_uID', Auth::user()->us_uID )->get();
        }
				
                foreach ( $getInventory as $keyInventory => $valueInventory ) {
                 //   if ( $valueInventory->us_uID == Auth::user()->us_uID ) {
                        $dateStart = Carbon::createFromFormat( 'Y-m-d', $value->start )->format( 'd/M/Y' );
                        $dateEnd = Carbon::createFromFormat( 'Y-m-d', $value->end )->format( 'd/M/Y' );
                        $timeStart = Carbon::createFromFormat( 'H:i:s', $value->res_time_start )->format( 'H:i' );
                        $timeEnd = Carbon::createFromFormat( 'H:i:s', $value->res_time_end )->format( 'H:i' );
                        $data_arr[] = [
                            "res_uID" => $value->res_uID,
                            "title" => $value->title,
                            "start" => $dateStart,
                            "timeStart" => $timeStart,
                            "timeEnd" => $timeEnd,
                            "number" => $value->res_person_number,
                            "place" => '<span class="pt-1 pb-1 pr-5 pl-5" style="background:' . $value->spacesGet->spa_color . '; color:white;">' . $value->spacesGet->spa_name . '</span>',
                            "options" => "<span id='$value->res_uID' class='view_details' onclick='view_details(id)'><i class='fas fa-eye fa-lg'></i></span>",
                        ];
                    //}
                }
            }


        }
        $response = array(
            "draw" => 1,
            "iTotalRecords" => count( $data_arr ),
            "iTotalDisplayRecords" => count( $data_arr ),
            "aaData" => $data_arr
        );
        return json_encode( $response );
    }

	    public function view( Request $request ) {
			 $getReservations = Reservation::where( 'res_uID',$request->res_uID)->get();
			foreach ( $getReservations as $key => $value ) {

                        $dateStart = Carbon::createFromFormat( 'Y-m-d', $value->start )->format( 'd/M/Y' );
                        $dateEnd = Carbon::createFromFormat( 'Y-m-d', $value->end )->format( 'd/M/Y' );
                        $timeStart = Carbon::createFromFormat( 'H:i:s', $value->res_time_start )->format( 'H:i' );
                        $timeEnd = Carbon::createFromFormat( 'H:i:s', $value->res_time_end )->format( 'H:i' );
				$getRelation = Relation::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'res_uID', $value->res_uID )->get();

            //dd($getRelation);
            foreach ( $getRelation as $keyRelation => $valueRelation ) {
                $getInventory = Inventory::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'inv_uID', $valueRelation->inv_uID )->get();
                foreach ( $getInventory as $keyInventory => $valueInventory ) {
					if ( $valueInventory->us_uID == Auth::user()->us_uID ) {
					$inventory[]=[
						"inv_name" => $valueInventory->inv_name,
						"res_inv_number" => $valueRelation->resinv_number,
					];
				}
				}
			}
				$data_arr[] = [
                            "res_uID" => $value->res_uID,
                            "title" => $value->title,
                            "start" => $dateStart,
                            "timeStart" => $timeStart,
                            "timeEnd" => $timeEnd,
                            "number" => $value->res_person_number,
                            "place" => $value->spacesGet->spa_name,
                            "modality" => $value->res_modality,
                            "user" => Crypt::decryptString($value->user->name),
                            "area" => $value->user->area->ar_name,
                            "description" => $value->res_description,
                            "resinv" => $value->resinv,
                            "mobiliario" => $inventory,
                        ];

			}
			return $data_arr;
		}

}
