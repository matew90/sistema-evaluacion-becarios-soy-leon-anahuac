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
use Carbon\Carbon;
use Auth;
use Log;

class ReservaController extends Controller {
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


    public function index( Request $request ) {
        /*$getSpaces = Spaces::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
        $getInventories = Inventory::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get();
         return view('ReservaEspacios.create',['spaces' => $getSpaces],['inventories' => $getInventories]);*/
    }

    public function create( Request $request ) {
        $getSpaces = Spaces::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->orderBy('spa_name', 'asc')->get();
        $getInventories = Inventory::where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->get();
        return view( 'ReservaEspacios.create', [ 'spaces' => $getSpaces ], [ 'inventories' => $getInventories ] );
    }

    public function show( Request $request ) {
        $getSpaces = Spaces::where( 'spa_uID', $request->spa_uID )->first();

        return $getSpaces->spa_person_number;
    }
    public function preview( Request $request ) {
        //////////////OBTENEMOS NOMBRE DEL LUGAR//////////////
        $getSpaces = Spaces::where( 'spa_uID', $request->place )->first();
        //////////////RECORREMOS ARRAY PARA INSERTAR RESERVAS//////////////
        for ( $i = $request->dateStart; $i <= $request->dateEnd; $i = date( "Y-m-d", strtotime( $i . "+ 1 days" ) ) ) { #start for
            if ( date( 'w', strtotime( $i ) ) != 0 ) {
                //////////////VALIDACIÓN DE RESERVAS EXISTENTES//////////////
                $reservation = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" )->where( 'spa_uID', '=', $request->place )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                $num = $reservation->count();
				$reservation3 = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_end', '=', $request->timeStart . ":00" )->where('resinv',1)->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                $num3 = $reservation3->count();
				
                if ( $num > 0 || $num3 > 0) { #1
                    $status = "danger";
                    $textStatus = "No disponible";
                } else { #1
                    $status = "success";
                    $textStatus = "Disponible";
                } #1

                ////////////////////DECLARAMOS ARRAY////////////////////////
                $infoInmob = array();
                ////////////////////RECORREMOS  ARRAY DE INMOBILIARIO////////////////////////
                if ( $request->inmobiliario == 1 ) {
                    foreach ( $request->inmob as $key => $valueInmob ) { #1
                        foreach ( $valueInmob as $valueInmob2 ) { #2

                            ////////////////////DECLARAMOS ARRAY////////////////////////
                            if ( $valueInmob2 > 0 ) { #3
                                $totavailability = 0;
                                $reservation2 = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                                $getReservation = $reservation2->where( 'resinv', 1 );

                                $getInvName = Inventory::where( 'inv_uID', $key )->first();
                                if ( $getReservation->count() > 0 ) {
                                    foreach ( $getReservation->get() as $keyRes => $valueRes ) {

                                        $consult = Relation::where( 'res_uID', $valueRes->res_uID )->where( 'inv_uID', $key )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                                        $total = $consult->sum( 'resinv_number' );
                                        $totavailability = $total + $totavailability;
                                        //dd($availability);

                                        ///////////////////DECLARACIÓN DE OPCIONES A MOSTRAR EN TOTAL DE INVENTARIO /////////////////////////

                                    }
                                    $tot = $getInvName->inv_number - $totavailability;
                                    if ( $tot >= $valueInmob2 ) {
                                        $number = $valueInmob2;
                                    } else {
                                        $number = $tot;
                                    }

                                    $infoInmob[] = [
                                        'name' => $getInvName->inv_name,
                                        'number' => $number
                                        //'number' => ( $total >= $getInvName->inv_number || $total == 0 ? $availability :$valueInmob2 )
                                    ];
                                } else {
                                    $infoInmob[] = [
                                        'name' => $getInvName->inv_name,
                                        'number' => ( $valueInmob2 >= $getInvName->inv_number ? $getInvName->inv_number : $valueInmob2 )
                                    ];
                                }
                            } #3
                        } #2
                    } #1
                } else {
                    $infoInmob = "";
                }

                /*if ( $request->inmobiliario == 1 ) {
                foreach ( $request->inmob as $key => $valueInmob ) { #1
                    foreach ( $valueInmob as $valueInmob2 ) { #2

                        ////////////////////DECLARAMOS ARRAY////////////////////////
                        if ( $valueInmob2 > 0 ) { #3

							$reservation2 = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" );
                            $getReservation = $reservation2->where( 'resinv', 1 );
                            if ( $getReservation->count() > 0 ) {
                                foreach ( $getReservation->get() as $keyRes => $valueRes ) {

                        $getInvName = Inventory::where( 'inv_uID', $key )->first();
                                    $consult = Relation::where( 'res_uID', $valueRes->res_uID )->where( 'inv_uID', $key )->where('sta_uID','023584f1-5547-429a-a131-3b3810d156c7');
                                    $total = $consult->sum( 'resinv_number' );
                                    $availability = $getInvName->inv_number - $total;
									//dd($availability);
									if($total==0 && $getInvName->inv_nunber >= $availability){
										$number=$valueInmob2;
									}elseif($total>0 && $getInvName->inv_number >= $availability){
										$number=$availability;
									}
                                    ///////////////////DECLARACIÓN DE OPCIONES A MOSTRAR EN TOTAL DE INVENTARIO /////////////////////////
                                    $infoInmob[] = [
                                        'name' => $getInvName->inv_name,
                                        'number' =>$availability
                                        //'number' => ( $total >= $getInvName->inv_number || $total == 0 ? $availability :$valueInmob2 )
                                    ];
                                }
                            } else {
                                $infoInmob[] = [
                                    'name' => $getInvName->inv_name,
                                    'number' => ( $valueInmob2 >= $getInvName->inv_number ? $getInvName->inv_number : $valueInmob2 )
                                ];
                            }
                        } #3
                    } #2
                } #1
            } else {
                $infoInmob = "";
            }
				*/
                $dateStart = Carbon::createFromFormat( 'Y-m-d', $i )->format( 'd/M/Y' );
                $dateEnd = Carbon::createFromFormat( 'Y-m-d', $i )->format( 'd/M/Y' );
                $generalInfo[] = [
                    'title' => $request->name,
                    'start' => $dateStart,
                    'end' => $dateEnd,
                    'res_time_start' => $request->timeStart,
                    'res_time_end' => $request->timeEnd,
                    'place' => $getSpaces->spa_name,
                    'color' => $getSpaces->spa_color,
                    'status' => $status,
                    'textStatus' => $textStatus,
                    'inmob' => $infoInmob,
                ];
            }
        } #end for

        return $generalInfo;

    }


    public function store( Request $request ) {
        //////////////OBTENEMOS NOMBRE DEL LUGAR//////////////
        $getSpaces = Spaces::where( 'spa_uID', $request->place )->first();
		$res_folio=Str::uuid();
		
		//dd($res_folio);
        //////////////RECORREMOS ARRAY PARA INSERTAR RESERVAS//////////////
        for ( $i = $request->dateStart; $i <= $request->dateEnd; $i = date( "Y-m-d", strtotime( $i . "+ 1 days" ) ) ) { #start for
            ////////////QUITAMOS DIA DOMINGO ///////////////

            if ( date( 'w', strtotime( $i ) ) != 0 ) {

                //////////////VALIDACIÓN DE RESERVAS EXISTENTES//////////////
                $reservation = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" )->where( 'spa_uID', '=', $request->place )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                $num = $reservation->count();
				
				
				$reservation3 = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_end', '=', $request->timeStart . ":00" )->where('resinv',1)->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                $num3 = $reservation3->count();
				
                ////////////////INSERTAMOS RESERVACIÓN DE ESPACIO////////////////////
                if ( $num == 0 && $num3==0) { #1

                    $create = Reservation::create( [
                        'res_uID' => Str::uuid(),
                        'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                        'title' => $request->name,
                        'start' => $i,
                        'end' => $i,
                        'res_time_start' => $request->timeStart,
                        'res_time_end' => $request->timeEnd,
                        'res_person_number' => $request->number,
                        'res_description' => $request->description,
                        'us_uID' => $request->us_uID,
                        'resinv' => $request->inmobiliario,
                        'res_modality' => ( $request->modality == "" ? 0 : $request->modality ),
                        'spa_uID' => $request->place,
                        'res_folio' => $res_folio
                    ] );


                    ////////////////////RECORREMOS  ARRAY DE INMOBILIARIO////////////////////////
                    if ( $request->inmobiliario == 1 ) {
                        foreach ( $request->inmob as $key => $valueInmob ) { #1
                            foreach ( $valueInmob as $valueInmob2 ) { #2

                                ////////////////////DECLARAMOS ARRAY////////////////////////
                                if ( $valueInmob2 > 0 ) { #3
                                    $totavailability = 0;
                                    $reservation2 = Reservation::whereDate( 'start', '=', $i )->whereDate( 'end', '=', $i )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" );
                                    $getReservation = $reservation2->where( 'resinv', 1 )->where( 'res_uID', '!=', $create->res_uID );
                                    //$getReservation = $reservation2->where( 'resinv', 1 );

                                    $getInvName = Inventory::where( 'inv_uID', $key )->first();
                                    if ( $getReservation->count() > 0 ) {
                                        foreach ( $getReservation->get() as $keyRes => $valueRes ) {

                                            $consult = Relation::where( 'res_uID', $valueRes->res_uID )->where( 'inv_uID', $key )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' );
                                            $total = $consult->sum( 'resinv_number' );
                                            //$availability = $getInvName->inv_number - $total;
                                            $totavailability = $total + $totavailability;
                                            //dd($totavailability);
                                            $numberTotal = $totavailability;
                                        }
                                    } else {
                                        $numberTotal = ( $valueInmob2 > $getInvName->inv_number ? $getInvName->inv_number : $valueInmob2 );
                                    }

                                    $tot = $getInvName->inv_number - $numberTotal;
                                    if ( $tot >= $valueInmob2 ) {
                                        $number = $valueInmob2;
                                    } else {
                                        $number = $tot;
                                    }

                                    ///////////////////INSERTAMOS MOBILIARIO A OCUPAR/////////////////////////
                                    if ( $number > 0 ) {
                                        Relation::create( [
                                            'resinv_uID' => Str::uuid(),
                                            'inv_uID' => $key,
                                            'resinv_number' => $number,
                                            'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                                            'res_uID' => $create->res_uID,
                                        ] );
                                    }

                                } #3
                            } #2
                        } #1

                        $getReservationComp = Relation::where( 'res_uID', $create->res_uID )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->count();
                        //dd($getReservationComp);
                        if ( $getReservationComp == 0 ) {
                            Reservation::where( 'res_uID', $create->res_uID )->update( [ 'resinv' => 2 ] );
                        }
                    }
                }
            }
        } #end for

					if(isset( $create->res_uID)){
 				$sendmail = $this->sendMail->sendMail(1,$create->res_uID ,$res_folio, $request->dateStart, $request->dateEnd,$request->inmob);
					}

        $result = [
            'title' => "Registro agregado",
            'type' => "success",
            'text' => "",
        ];
        Log::info( 'Create reserva name: ' . $request->title . ' by: ' . Auth::user()->us_uID );
        return json_encode( $result );


        Log::error( 'Create reserva name by: ' . Auth::user()->us_uID . " Line: 48. ReservaController." );
        return json_encode( $result );
    }

    public function update( Request $request ) {

        $updateReservation = Reservation::where( 'res_uID', $request->res_uID )->update( [ 'title' => $request->name, 'res_person_number' => $request->number, 'res_description' => $request->description, 'res_modality' => $request->modality, 'resinv' => $request->inmobiliario, 'updated_by' => Auth::user()->us_uID ] );
        //////////////VALIDACIÓN DE RESERVAS EXISTENTES//////////////
        $reservation = Reservation::whereDate( 'start', '=', $request->dateStart )->whereDate( 'end', '=', $request->dateEnd )->whereTime( 'res_time_start', '<=', $request->timeStart . ":00" )->whereTime( 'res_time_end', '>=', $request->timeEnd . ":00" );;
        if ( $request->inmobiliario == 1 ) { #1 Si selecciona mobiliario

            /////////////MODIFICAMOS MOBILIARIO EXISTENTE///////////////////
            foreach ( $request->inmob as $key => $valueInmob ) { #1
                foreach ( $valueInmob as $valueInmob2 ) { #2

                    $getInvName = Inventory::where( 'inv_uID', $key )->first();
                    ////////////////////DECLARAMOS ARRAY////////////////////////
                    if ( $valueInmob2 > 0 ) { #3
                        $totavailability = 0;
                        $getReservation = $reservation->where( 'resinv', 1 );
                        if ( $getReservation->count() > 0 ) {
                            foreach ( $getReservation->get() as $keyRes => $valueRes ) {
                                $consult = Relation::where( 'res_uID', $valueRes->res_uID )->where( 'inv_uID', $key )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->where( 'res_uID', '!=', $request->res_uID );
                                $total = $consult->sum( 'resinv_number' );
                                //$availability = $getInvName->inv_number - $total;
                                $totavailability = $total + $totavailability;

                                //dd($totavailability);
                                $numberTotal = $totavailability;
                            }
                        } else {
                            $numberTotal = ( $valueInmob2 > $getInvName->inv_number ? $getInvName->inv_number : $valueInmob2 );
                        }


                        $tot = $getInvName->inv_number - $numberTotal;
                        if ( $tot >= $valueInmob2 ) {
                            $number = $valueInmob2;
                        } else {
                            $number = $tot;
                        }

                        if ( Relation::where( 'res_uID', $valueRes->res_uID )->where( 'inv_uID', $key )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->count() > 0 ) {
                            Relation::where( 'res_uID', $request->res_uID )->where( 'inv_uID', $key )->update( [ 'resinv_number' => $number ] );
                        } else {
                            if ( $number > 0 ) {
                                Relation::create( [
                                    'resinv_uID' => Str::uuid(),
                                    'inv_uID' => $key,
                                    'resinv_number' => $number,
                                    'sta_uID' => '023584f1-5547-429a-a131-3b3810d156c7',
                                    'res_uID' => $request->res_uID,
                                ] );
                            }
                        }
                        ///////////////////INSERTAMOS MOBILIARIO A OCUPAR/////////////////////////
                    } #3
                } #2
            } #1
            $getReservationComp = Relation::where( 'res_uID', $valueRes->res_uID )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->count();
            //dd($getReservationComp);
            if ( $getReservationComp == 0 ) {
                Reservation::where( 'res_uID', $valueRes->res_uID )->update( [ 'resinv' => 2 ] );
            }
            $result = [
                'title' => "Registro actualizado",
                'type' => "success",
                'text' => "",
            ];

        } else { #1

            /////////BUSCAMOS Y ELIMINAMOS MOBILIARIO REQUERIDO ANTERIORMENTE///////////
            $relation = Relation::where( 'res_uID', $request->res_uID )->where( 'sta_uID', '023584f1-5547-429a-a131-3b3810d156c7' )->count();
            if ( $relation > 0 ) {
                $updateRelationn = Relation::where( 'res_uID', $request->res_uID )->update( [ 'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a' ] );
            }
            $result = [
                'title' => "Registro actualizado",
                'type' => "success",
                'text' => "",
            ];
        } #1
		
		$sendmail = $this->sendMail->sendMail(3, $request->res_uID,$request->res_folio,$request->dateStart, $request->dateEnd,$request->inmob);
        return json_encode( $result );
    }
}
