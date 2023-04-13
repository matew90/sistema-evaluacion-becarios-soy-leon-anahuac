<?php

namespace App\ Http\ Controllers\ ReservaEspacios;

use App\ Http\ Controllers\ Controller;
use PHPMailer\ PHPMailer\ PHPMailer;
use PHPMailer\ PHPMailer\ Exception;
use Illuminate\ Mail\ Mailable;
use Mailgun\ Mailgun;
use App\ Models\ User;
use App\ Models\ general\ Reservation;
use App\ Models\ general\ Relation;
use App\ Models\ general\ Inventory;

class MailController extends Controller {


    public function sendMail( $number_email, $res_uID, $res_folio,$dateStart, $dateEnd, $mobiliario) {


        $domain = "soyleon.anahuacqro.edu.mx";
        $mgClient = Mailgun::create( env( 'MAILGUN_PASS' ), env( 'MAILGUN_DOMAIN' ) );

        // OBTENEMOS DATOS DE LA RESERVACION
        $getReservation = Reservation::where( 'res_uID', $res_uID )->first();
        $getSendMail = $getReservation->user->email;
        /*	if($getReservation->resinv == 1){
        		$getRelation=Relation::where('res_uID',$res_uID)->get();
        		foreach($getRelation as $Key => $value){
        			$getInventory=base64_decode($value->getInventory->user->email);
        			$getSendMailCc[]=$getInventory;
        			  $getSendMailC = implode( ",", array_unique( $getSendMailCc, SORT_REGULAR ) );
        	$getSendMailC= ltrim ($getSendMailC, ',');
        		}
        	}else{
        		$getSendMailC='';
        	}
        	*/
        $getSendMailC = '';
		$getDateStart= $dateStart;
		$getDateEnd= $dateEnd;
		$getTimeStart= $getReservation->res_time_start;
		$getTimeEnd= $getReservation->res_time_end;
		$place= $getReservation->spacesGet->spa_name;
		
		
		if($getReservation->resinv ==1){
			
		foreach($mobiliario as $key => $value){
			if($value[0] > 0){
				$getMobiliario=Inventory::where('inv_uID', $key)->first();
				$mob_name[] = $getMobiliario->inv_name.": ".$value[0];	
			}
		}
		
		//$mobiliarioGet=str_replace('}','',str_replace('{','',json_encode($mob_name)));
		$mobiliarioGet=implode(",",$mob_name);
		//print_r($mob_name);
		
		}else{
			$mobiliarioGet="N/A";
		}
		
        $comments = "";
        switch ( $number_email ) {
            case 1:

                ///////////RESERVACION CREADA///////////
                $mails = [
                    [
                        'sub' => 'Reservación - ' . $getReservation->title,
                        'template' => 'soy-leon',
                        'vars' => '{
										"message": "Se ha creado una reservación de espacio con el nombre de ' . $getReservation->title . '.",
										"espacio": "' . $place . '",
										"fecha_inicio": "' . $getDateStart . '",
										"fecha_fin": "' . $getDateEnd . '",
										"hora_inicio": "' . $getTimeStart . '",
										"hora_fin": "' . $getTimeEnd. '",
										"mobiliario": "' . $mobiliarioGet. '"
									}',
                        'recipients' => base64_decode( $getReservation->user->email ),
                        'recipientsCOM' => $getSendMailC

                    ]
                ];

                break;
            case 2:

                 $mails = [
                    [
                        'sub' => 'Reservación - ' . $getReservation->title,
                        'template' => 'soy-leon',
                        'vars' => '{
										"message": "Se ha actualizado la reservación de espacio con el nombre de ' . $getReservation->title . '.",
										"espacio": "' . $place . '",
										"fecha_inicio": "' . $getDateStart . '",
										"fecha_fin": "' . $getDateEnd . '",
										"hora_inicio": "' . $getTimeStart . '",
										"hora_fin": "' . $getTimeEnd. '",
										"mobiliario": "' . $mobiliarioGet. '"
									}',
                        'recipients' => base64_decode( $getReservation->user->email ),
                        'recipientsCOM' => $getSendMailC

                    ]
                ];
                break;
            case 3:

                 $mails = [
                    [
                        'sub' => 'Reservación - ' . $getReservation->title,
                        'template' => 'soy-leon',
                        'vars' => '{
										"message": "Se ha actualizado la reservación de espacio con el nombre de ' . $getReservation->title . '.",
										"espacio": "' . $place . '",
										"fecha_inicio": "' . $getDateStart . '",
										"fecha_fin": "' . $getDateEnd . '",
										"hora_inicio": "' . $getTimeStart . '",
										"hora_fin": "' . $getTimeEnd. '",
										"mobiliario": "' . $mobiliarioGet. '"
									}',
                        'recipients' => base64_decode( $getReservation->user->email ),
                        'recipientsCOM' => $getSendMailC

                    ]
                ];
                break;
            case 4:

                 $mails = [
                    [
                        'sub' => 'Reservación - ' . $getReservation->title,
                        'template' => 'soy-leon',
                        'vars' => '{
										"message": "Se ha cancelado la reservación de espacio con el nombre de ' . $getReservation->title . '.",
										"espacio": "' . $place . '",
										"fecha_inicio": "' . $getDateStart . '",
										"fecha_fin": "' . $getDateEnd . '",
										"hora_inicio": "' . $getTimeStart . '",
										"hora_fin": "' . $getTimeEnd. '",
										"mobiliario": "' . $mobiliarioGet. '"
									}',
                        'recipients' => base64_decode( $getReservation->user->email ),
                        'recipientsCOM' => $getSendMailC

                    ]
                ];

                break;
        }

        $mime_string = 'Content-Type: text/html; charset=utf-8';

        for ( $i = 0; $i < count( $mails ); $i++ ) {
            $params = array(
                'from' => 'No reply Soy León <noreply@soyleon.anahuacqro.edu.mx>',
                'to' => $mails[ $i ][ 'recipients' ],
                'cc' => $mails[ $i ][ 'recipientsCOM' ],
                'subject' => $mails[ $i ][ 'sub' ],
                'template' => $mails[ $i ][ 'template' ],
                'h:X-Mailgun-Variables' => $mails[ $i ][ 'vars' ]
            );

            $result = $mgClient->messages()->send( $domain, $params );
        }
        return 1;
    }

}