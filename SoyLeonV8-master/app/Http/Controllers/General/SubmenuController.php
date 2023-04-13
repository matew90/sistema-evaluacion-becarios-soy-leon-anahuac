<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\General\Status;
use App\Models\General\Submenu;
use App\Models\General\Menu;
use Auth;
use Log;


class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Submenu.index');
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

      return view('Admin.Submenu.create', compact('getStatus', 'getMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if (Submenu::where('sub_name', 'LIKE', $request->name)->count()) {
        return back()->with('msg', ['warning', 'Registro duplicado.']);
      }
      
      $breadArray = [
        'B' =>[
          'route' => $request->name_b,
          'name' => $request->public_b,
          'slug' => $request->slug_b
        ],
        'R' =>[
          'route' => $request->name_r,
          'name' => $request->public_r,
          'slug' => $request->slug_r
        ],
        'E' =>[
          'route' => $request->name_e,
          'name' => $request->public_e,
          'slug' => $request->slug_e,
        ],
        'A' =>[
          'route' => $request->name_a,
          'name' => $request->public_a,
          'slug' => $request->slug_a
        ],
        'D' =>[
          'route' => $request->name_d,
          'name' => $request->public_d,
          'slug' => $request->slug_d
        ],
        'U' =>[
          'name' => $request->name_u,
          'slug' => $request->slug_u,
        ],
        'S' =>[
          'name' => $request->name_s,
          'slug' => $request->slug_s,
        ]
      ];

      Submenu::create([
        'sub_uID' => Str::uuid(),
        'men_uID' => $request->menu,
        'sta_uID' => $request->status,
        'sub_name' => $request->name,
        'sub_route' => $request->route,
        'sub_slug' => $request->slug,
        'sub_bread' => json_encode($breadArray),
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
