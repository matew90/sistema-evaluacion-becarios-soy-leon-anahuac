<?php

/**
 *
 * Descripción de la clase
 * Juan Pablo Moreno Mendoza
 * Fecha de creación
 * Última actualización
 * Versión de la clase: 1.0.0
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MsGraph;
use Session;
use Log;
use App\Models\User;
use App\Models\General\Role;
use App\Models\General\Status;
use App\Models\General\Campus;
use Dcblogdev\MsGraph\Facades\MsGraph as Api;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class PagesController extends Controller
{
   public function app()
    {
        //REVISAMOS SI ESTA REGISTRADO EL CORREO
        if (Auth::user() == null) {
            return redirect()->route('login');
        }
        $checkMail = User::where('email', 'LIKE', '%' . Auth::user()->email . '%')->first();

        if ($checkMail->status->name == 'Activo') { #1
            //////ENCRIPTAMOS ID //////
            return redirect('inicio');
            // return view('registerUser');
        } else { #1

            if ($checkMail->status->name =='Pendiente') {
                ////CONSULTAMOS API (wsGetIdBanner) PARA OBTENER TOKEN /////
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://uft-integ-prod.ec.lcred.net/wsGetIdBanner/token',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => 'grant_type=password&username=GetIdByEmail',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic R2V0SWRCeUVtYWlsOjFnZTdkSDhvdXEvUytVMzlLUG1BcGlnd0ZRTmNVT085SVRkcHhuWFFTNUtEYnl4SUp1VUQwNUlBVTYxRCtRNDNqbzlFYmNHd3d2dklUdWxzQUMrR1AxQ0NxSis3SGIwYXQ5bnJNdmZmSys4bGRzSnFGWEpDcVFLZ0Y3aFE5dXZFNGJwUXdmOGJ6TWhDWFQzWXFpUytmSldJWXN1N1F0UnRFTWdvbEF0dkkzcC9YazFwcnBLU1p5MDl3K3czeHJ3cE5DVEFaQjdIOVFDTFVQYUxFY2NnNmU4SDZ6K3dyR3VzRjJoR3lzZ1NOMEU9',
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                ));

                $response = curl_exec($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $var = json_decode($response, true);
                $token = $var[ 'access_token' ];
                curl_close($curl);
                //// SI API NO FUNCIONA CIERRA LA SESION
                if ($httpcode != 200) {
                    return redirect('logout');
                }


                /////OBTENEMOS ID BANNER DEL ALUMNO O PROFESOR CON API (wsGetIdBanner)/////

                $curlData = curl_init();
                curl_setopt_array($curlData, array(
                    CURLOPT_URL => 'https://uft-integ-prod.ec.lcred.net/wsGetIdBanner//api/srvGetIdBannerByEmail',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
					"email": "juanpablo.moreno@anahuac.mx"
				}',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $token . '',
                        'Content-Type: application/json'
                    ),
                ));

                $responseData = curl_exec($curlData);
                $httpcodeData = curl_getinfo($curlData, CURLINFO_HTTP_CODE);
                $data = json_decode($responseData);
                foreach ($data as $row) {
                }
                curl_close($curlData);
                //// SI API NO FUNCIONA CIERRA LA SESION
                if ($httpcodeData != 200) {
                    return redirect('logout');
                }


                ////CONSULTAMOS API (wsAccesoDatos) PARA OBTENER TOKEN /////
                $curlAccess = curl_init();

                curl_setopt_array($curlAccess, array(
                    CURLOPT_URL => 'https://uft-integ-prod.ec.lcred.net/wsAccesoDatos/token',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS => 'grant_type=password&username=AccesoDatosUAQ',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic QWNjZXNvRGF0b3NVQVE6VnZxa2hNRTNGejM2Yk05cDhMVy8vTTJFNjAvWE5uZjI4MVNTNnh6eHRqNzlsQW9NYUxwek50TlpGaVdIMnJHVkxWcldLOHRqU1hQQWluOHVhbktVRW5YOTFTTEhDY2pjZlRQL0docjJJVnEvbjhxdkMvaVFQL01XbDB0QnJndlZlS0JFdlp4c1N3d01GMUYrdEZ5MFhSOFRiOFN0Tnk4SENlQnN3cEtMZzNGaFRFMU5GMTljL0xTbVFId0RPUWVyeGoxYXJJaEZMRmpIUXd5ZDR6dk5XYmRpMGFhZTFUQm0vQWdWaDZyNk84bWdtNG8vYllzWkVaYjNBSjByekhvaVpXbjRIMXdKWFV2ZFNhelJEWDBka05kdHpjZDFPS0ZoMFhjSW9MZ1NKSU09',
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                ));

                $responseAccess = curl_exec($curlAccess);
                $httpcodeAccess = curl_getinfo($curlAccess, CURLINFO_HTTP_CODE);

                //// SI API NO FUNCIONA CIERRA LA SESION
                if ($httpcodeAccess != 200) {
                    return redirect('logout');
                }

                $varAccess = json_decode($responseAccess, true);
                $tokenAccess = $varAccess[ 'access_token' ];
                curl_close($curlAccess);

                /////OBTENEMOS DATOS DEL ALUMNO O PROFESOR CON API()////
                $curlPerson = curl_init();

                curl_setopt_array($curlPerson, array(
                    CURLOPT_URL => 'https://uft-integ-prod.ec.lcred.net/wsAccesoDatos/api/srvDatosPersona',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"id_banner":"00456072"}',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $tokenAccess . '',
                        'Content-Type: application/json'
                    ),
                ));
                $responsePerson = curl_exec($curlPerson);
                $httpcode2 = curl_getinfo($curlPerson, CURLINFO_HTTP_CODE);

                if ($httpcode2 != 200) { #2
                    return redirect('logout');
                }
                $dataPerson = json_decode($responsePerson);
                curl_close($curlPerson);
                foreach ($dataPerson as $rowPerson) {
                }


                ////OBTENEMOS ROLL
                $getRoll = Role::where('rol_name', $rowPerson->ROLL)->get();
                foreach ($getRoll as $key => $value) {
                }

                ////OBTENEMOS STATUS
                $getStatus = Status::where('name', 'LIKE', '%' . $rowPerson->STAT . '%')->get();
                foreach ($getStatus as $keyStatus => $valueStatus) {
                }
                ////OBTENEMOS CAMPUS
                $getCampus = Campus::where('cam_nickname', 'LIKE', '%' . $rowPerson->CAMS . '%')->get();
                foreach ($getCampus as $keyCampus => $valueCampus) {
                }

                User::where('email', Auth::user()->email)->update([ 'rol_uID' => $value->rol_uID, 'camp_uID' => $valueCampus->camp_uID, 'sta_uID' => $valueStatus->sta_uID, 'us_banner_guid' => $rowPerson->GUID, 'us_banner_id' => Crypt::encryptString($row->id_banner) ]);
                //dd($valueStatus->id);

                //////SI NO ESTA ACTIVO CIERRA SESION//////
                if ($rowPerson->STAT != 'Activo' || $rowPerson->CAMS !="UAQ") {
                    return redirect('logout');
                }
                return redirect('inicio');
            }

            Log::error('PageController don\'t condition. Line 186');
        } #1
    }

    public function index()
    {
        return view('inicio');
    }
}
