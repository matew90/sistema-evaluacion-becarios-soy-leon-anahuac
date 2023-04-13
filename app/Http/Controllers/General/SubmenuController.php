<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\general\Status;
use App\Models\general\Submenu;
use App\Models\general\Menu;
use Auth;
use Log;
use Illuminate\Routing\Redirector;


class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $submenu = Submenu::all();
      // dd($submenu->toArray());
        return view('Admin.Submenu.index', compact('submenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getStatus = Status::all();
      $getMenu = Menu::all();
      $getSubmenu = Submenu::all();

      return view('Admin.Submenu.create', compact('getStatus', 'getMenu', 'getSubmenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->menu);
      if(isset($request->sub_parent_uID)){
        $get_parent = Submenu::where('sub_parent_uID', $request->sub_parent_uID)->first();
        $route = explode('.', $get_parent->sub_route);
        $sub_route = $route[0].'.'.$route[1].'.'.$request->route;
      }else {
        $get_menu = Menu::where('men_uID', $request->menu)->first();
        $sub_route = $get_menu->men_route.'.'.$request->route.'.index';
      }

      if (Submenu::where('sub_route', 'LIKE', $sub_route)->count()) {
        return back()->with('msg', ['warning', 'Registro duplicado.']);
      }

      $sub_uID = Str::uuid();

      Submenu::create([
        'sub_uID' => $sub_uID,
        'men_uID' => $request->men_uID,
        'sta_uID' => $request->status,
        'sub_name' => $request->name,
        'sub_route' => $sub_route,
        'sub_slug' => $request->slug,
        'sub_visible' => $request->visible,
        'sub_parent_uID' => empty($request->sub_parent_uID)?$sub_uID:$request->sub_parent_uID,
        'created_by' => Auth::user()->us_uID,
        'updated_by' => Auth::user()->us_uID,
      ]);

      Log::info('Create submenu name: '.$request->name.' by: '.Auth::user()->us_uID);
      return back()->with('msg', ['success', 'Registro agregado.']);

    // } catch (\Exception $e) {
      Log::error('Create submenu name by: '.Auth::user()->us_uID." Line: 61. MenuController.");
      return back()->with('msg', ['danger', 'No se ha podido guardar el registro.']);

    // }
        // dd($request->toArray());
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
        $sub_edit=Submenu::where('sub_uID', $id)->first();
        $getStatus = Status::all();
        $getMenu = Menu::all();
        $getSubmenu = Submenu::all();

        return view('Admin.Submenu.create', compact('sub_edit', 'getStatus','getMenu', 'getSubmenu'));
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
      Submenu::where('sub_uID',$id)->update([
        'men_uID' => $request->menu,
        'sta_uID' => $request->status,
        'sub_name' => $request->name,
        'sub_route' => $request->route,
        'sub_slug' => $request->slug,
        'sub_visible' => $request->visible,
        'sub_parent_uID' => empty($request->sub_parent_uID)?$id:$request->sub_parent_uID,
        'updated_by' => Auth::user()->us_uID,
      ]);
      return redirect()->route('admin.submenu.index');

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
