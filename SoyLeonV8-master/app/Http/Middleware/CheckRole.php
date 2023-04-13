<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\General\Menu;
use App\Models\General\Submenu;
use App\Models\General\Role;
use Route;
use Session;
use Log;

class CheckRole
{
  public function __construct()
  {
    $this->route = \Request::route()->getName();
    $this->us_uID = Auth::user()->us_uID;
    $this->role_us_uID = Auth::user()->rol_uID;
  }
    /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()===null) {
            return $next($request);
        }

        $role=Role::where("rol_uID", $this->role_us_uID)->first();

        if ($role == null) {
          Log::error('Middleware CheckRole: Role don\'t found: '.$this->us_uID.' Line 36');
          return redirect('inicio');
        }

        $getmenu=Menu::where('men_route', $this->route)->first();




        /**
         * first index = men_uID
         *
         * B BROWSE / INDEX
         * R READ / SHOW
         * E EDIT / EDIT / UPDATE
         * A ADD / CREATE / STORE
         * D DELETE
         *
         * LEVEL
         * none = Without permission
         * all
         * area
         * own
         *
         * @var array
         */
        /*$role = [
          "a36f31ae-b56e-4022-ad2c-6fcd67870119" => [

            'B' => 'all',
            'R' => 'all',
            'E' => 'all',
            'A' => 'all',
            'D' => 'all',
          ]
        ];

        echo json_encode($role);

        dd(Auth::user()->role->rol_name);*/

        $exist = array_key_exists($getmenu->men_uID, json_decode($role->rol_permissions, true));
        if ($exist == false) {
            Log::error('Middleware CheckRole: Denied Access Auth: '.$this->us_uID.' Line 186');
            return redirect('inicio');
        }
        if ($exist == true) {
            Log::error('Middleware CheckRole: Access Auth: '.$this->us_uID. $this->route);
            return $next($request);
        }
    }
}
