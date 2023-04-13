<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\general\Submenu;
use App\Models\general\Area;
use App\Models\User;
use Auth;
use Route;

class FunctionController extends Controller
{
    public function checkRoleProperty($route)
    {
        if(Auth::user()->role->rol_level===100){
            return 'all';
        }
        $rol_permissions= json_decode(Auth::user()->role->rol_permissions, true);
        $submenu=Submenu::where('sub_route', $route)->first()->sub_uID;
        return isset($rol_permissions[$submenu][0]['property'])?$rol_permissions[$submenu][0]['property']:"none";
        /* return json_decode(Auth::user()->role->rol_permissions, true)[Submenu::where('sub_route', Route::currentRouteName())->first()->sub_uID][0]['property']; */
    }

    public function userAssig($route){
        $property = $this->checkRoleProperty($route);
        switch ($property){
            case "area":
                $area = Area::where('ar_parent_uID','=',Auth::user()->ar_uID)->get();
                $ar_user = User::select('*');
                $ar_user->where(function ($query) use ($area) {
                    foreach($area as $key => $value){
                        $query->orWhere('ar_uID',$value->ar_uID);
                    }
                });
                $user = $ar_user->get();
                break;
            case "subarea":
                $user = User::where('ar_uID','=',Auth::user()->ar_uID)->get();
                break;
            case "own":
                $user = OdtGeneral::where('gen_user_assign','=',Auth::user()->us_uID)->get();
                break;
            default:
            break;
        }
        return $user;

    }
    public function remplaceBeca( $porcentaje ) {

        $vowels = array( "b", "c", "d", "e");
        $vowels2 = array( '5 a 25', '26 a 50', '56 a 75', '76 a 100');
        $beca = str_replace( $vowels, $vowels2, $porcentaje ) ;
        return $beca;
    }

}
