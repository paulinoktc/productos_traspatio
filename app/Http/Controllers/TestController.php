<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Municipio;
use App\Models\Produccion_comunidad;
use App\Models\Producto;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipio = 2;
        $productos = Producto::all(); // find(23);
        $data = null;
        foreach ($productos as $value) {
            $datos = null;
            $datos['producto'] = $value;
            //-----------------------------------------------------------------------------------TOTAL TONELADAS
            $total_toneladas = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidades.municipio_id', $municipio)
                ->sum('aprox_toneladas');
            $total_toneladas = number_format($total_toneladas, 5, '.', '');
            $datos['t_toneladas'] = $total_toneladas;

            //-----------------------------------------------------------------------------------VALOR PRODUCCION
            $valor_produccion = $total_toneladas * $value->cosechas * $value->precio_kg;
            $valor_produccion = number_format($valor_produccion, 6, '.', '');
            $datos['valor_produccion'] = $valor_produccion;

            //----------------------------------------------------------------------------------- AUTOCONSUMO
            $autoconsumo = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_autoconsumo');
            $datos['autoconsumo'] = $autoconsumo;

            //----------------------------------------------------------------------------------- DESPERDICIO
            $desperdicio = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_desperdicio');
            $datos['desperdicio'] = $desperdicio;

            //----------------------------------------------------------------------------------- VENTA
            $venta = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_venta');
            $datos['venta'] = $venta;
            $data[] = $datos;

            $nombres[] =  $value->nombre;
        }

        //return $data;
        return view('test.test', compact('data'));


        $name = "hortaliza";
        $dato = ['name' => 'dos'];
        $tres = ['name' => 'tres'];
        $datos = ['uno' => $dato, 'dos' => $tres];
        foreach ($datos as $key => $value) {
            return $value['name'];
        }
        return $datos;
        $comunidad = Categoria::where('categoria', 'LIKE', '%' . $name . '%')->get();

        return $comunidad;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $municipios = Municipio::all();
        $comunidades = Comunidad::all();
        return view('test.select', compact('municipios', 'comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Comunidad::where('municipio_id', $id)->get();
        $list = "";
        foreach ($element as  $value) {
             echo $list . '<option value="' . $value->id . '">' . $value->nombre . '</option>';
        }
        //return $list;
    }

    public function elements($id)
    {
        $element = Comunidad::where('municipio_id', $id)->get();
        $list = "";
        foreach ($element as  $value) {
            echo $list . '<option value="' . $value->id . '">' . $value->nombre . '</option>';
        }
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
