<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comunidad;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = 0.009;
        $dato2 = (40 / 100);
        $res = $dato * $dato2;
        $res = number_format($res, 5, '.', '');
        return $res;
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
        
        Comunidad::create([
            'nombre' => $request->comunidad,
            'municipio_id' => $request->municipio_s
        ]);

        return redirect()->route('municipio.index')->with('comunidad', 'ok');
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
        $comunidad = Comunidad::find($id);

        $comunidad->nombre = $request->comunidad;
        $comunidad->municipio_id = $request->municipio_s;
        $comunidad->save();

        return redirect()->route('municipio.index')->with('comunidad', 'edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comunidad::find($id)->delete();
        return redirect()->route('municipio.index')->with('eliminar', 'ok');
    }
}
