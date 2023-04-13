<?php



namespace App\Http\Controllers\General;



use App\Http\Controllers\Controller;

use App\Models\General\Role;

use App\Models\General\Submenu;

use App\Models\User;

use Str;

use Auth;

use Illuminate\Http\Request;



class RolesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $roles = Role::all();

        //dd($roles);

        return view('Admin.Roles.index', compact('roles'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

      $getRegister = Submenu::orderBy('sub_name','ASC')->get();

      $getUsers = User::all();

      foreach ($getRegister as $menuKey => $menu) {

        $na[$menu->men_uID][$menu->sub_parent_uID][] = $menu;

      }

        return view('Admin.Roles.create', compact('na', 'getUsers'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

      $permissions = array();



      foreach ($request->property as $subUID) {

        $sub = explode('_', $subUID);

        if($sub[1] !== 'none'){

          $permissions[$sub[0]][] = [

            'property' => $sub[1]

          ];

        }

      }



      $rol_uID=Str::uuid();

      $rol = Role::create([

        'rol_uID' => $rol_uID,

        'sta_uID' => '9569bcce-0869-40b9-b6c5-c7b72c91996a',

        'camp_uID' => '31eec942-8945-4096-8815-b39e97f782c5',

        'rol_name' => $request->rol_name,

        'rol_level' => 10,

        'rol_permissions' => json_encode($permissions),

        'first_sub_uID' => $request->first_submenu_id,

        'created_by' => Auth::user()->us_uID,

        'updated_by' => Auth::user()->us_uID

      ]);



      return redirect()->route('admin.role.index');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

}

