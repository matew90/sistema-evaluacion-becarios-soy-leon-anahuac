<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\general\Role;
use App\Models\general\User;
use App\Models\general\Status;
use App\Models\general\Menu;
use App\Models\general\Submenu;
use Auth;
use Session;
use Log;
use Route;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class RoleComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    // protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->user = Auth::user();
        $this->route = explode('.', Route::currentRouteName());
        $this->complete_route = Route::currentRouteName();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

      $submenu = Submenu::all();

        if (Auth::user() == null) {
            return 0;
        }

        $major_menu=[];
        $indexKey = "";

        /**
         * Role permission if  role level = 100 get all submenus
         * @var array $getSubmenu permissions
         */

        if ($this->user->role->rol_level==100) {
            $getSubmenu = Submenu::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->where('sub_visible',1)->get()->groupBy('men_uID');
        } else {
          $getSubmenu = Submenu::where('sta_uID', '023584f1-5547-429a-a131-3b3810d156c7')->get()->groupBy('men_uID');

             // $getSubmenu = Submenu::whereIn('men_uID', array_keys(json_decode($this->user->role->rol_permissions, true)))->get()->groupBy('men_uID');
        }

        $getCurrentSubmenu= Submenu::where('sub_route', $this->complete_route)->first();
        

        /**
         * [if] exists menu route name
         * Select Menu info
         * @var array $submenus key = 0
         */

         
        if (isset($this->route[0])) {
            $getRouteInfo = Menu::where('men_route', $this->route[0])->first();
            
            foreach ($getSubmenu[$getRouteInfo->men_uID] as $key => $value) {
              if ($value->sub_parent_uID==$value->sub_uID) {
                $submenus[$value->sub_uID][] = [
                  'menu_name' => $getRouteInfo->men_name,
                  'name' => $value->sub_name,
                  'route_name' => $value->sub_route,
                  'menu_route_name' => $getRouteInfo->men_route,
                  'icon' => $value->sub_icon,
                  'prefix' => $value->sub_slug,
                  'men_prefix' => $value->men_slug,
                  'values' => array()
                ];
              }

              if ($value->sub_parent_uID!=$value->sub_uID) {
                $submenus[$value->sub_parent_uID]['values'][] = [
                    'name' => $value->sub_name,
                    'route_name' => $value->sub_route,
                    'prefix' => $value->sub_slug,
                ];
              }
            }
        }
        if ($getRouteInfo == null) {
            Log::error('Error get route name, don\'t found database: '.Auth::user()->us_uID." Line: 56. RoleComposer.");
            return view('errors.404');
        }

        /**
         * @var array $getSubmenu get all permission
         */
        $info=[
          'submenu' => $getSubmenu,
          'submenus_list' => $submenus,
          'act_submenu_route' => $this->complete_route,
          'currentSubmenu' => $getCurrentSubmenu
        ];

        // dd($info['submenus_list']);
        // dd($getCurrentSubmenu->toArray());
        return $view->with('info', $info);
    }
}
