<?php

namespace App\Http\Controllers\Import;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
	
class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
	public function import(Request $request)
    {
		
		
		if($request->hasFile('document')){
			$path1 = $request->file('document')->store('temp'); 
$path=storage_path('app').'/'.$path1;  
$data = \Excel::import(new UsersImport,$path);
			/*$file=$request->file;
			Excel::import(new UsersImport, $file);
				return redirect('/administrativos')->with('success', 'All good!');*/
		}
       /* if($request->hasFile('document')){
			$path = $request->file('document')->getRealPath();
			$datos = Excel::load($path,function($reader){
			})->get();
			
			if(!empty($datos) && $datos->count()){
				$datos=$datos->toArray();
				for($i=0; $i<count($datos); $i++){
					$datosImportar[]=$datos[$i];
				}
				dd($datosImportar);
				//User::insert($datosImportar);
			}
			return back();
		}*/
    }
}
