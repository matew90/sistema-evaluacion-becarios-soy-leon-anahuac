<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\General\Status;
use App\Models\General\Menu;
use App\Models\General\Category;
use Auth;
use Log;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Menu.index');
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
      $getCategory = Category::all();

      return view('Admin.Menu.create', compact('getStatus', 'getMenu', 'getCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // try {

        if (Menu::where('men_name', 'LIKE', $request->name)->count()) {
          return back()->with('msg', ['warning', 'Registro duplicado.']);
        }

        Menu::create([
          'men_uID' => Str::uuid(),
          'sta_uID' => $request->status_id,
          'men_name' => $request->name,
          'men_slug' => $request->slug,
          'men_icon' => $request->icon,
          'men_route' => $request->route_name,
          'cat_uID' => $request->category_id,
          'created_by' => Auth::user()->us_uID,
          'updated_by' => Auth::user()->us_uID,
        ]);

        Log::info('Create menu name: '.$request->name.' by: '.Auth::user()->us_uID);
        return back()->with('msg', ['success', 'Registro agregado.']);

      // } catch (\Exception $e) {
        Log::error('Create menu name by: '.Auth::user()->us_uID." Line: 61. MenuController.");
        return back()->with('msg', ['danger', 'No se ha podido guardar el registro.']);

      // }
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
