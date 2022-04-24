<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\RegistrosImport;
use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Municipio;
use App\Models\Produccion_comunidad;
use App\Models\Producto;
use App\Models\Um_produccion;
use App\Models\Um_terreno;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_municipio =  Municipio::min('id');
        $s_comunidad = Comunidad::where('municipio_id', $s_municipio)->min('id');
        $s_categoria = 0;
        $s_producto = 0;

        $municipios = Municipio::orderBy('id', 'asc')->get();
        $comunidades = Comunidad::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('categoria')->get();
        $productos = Producto::orderBy('nombre')->get();

        $um_produccion = Um_produccion::orderBy('unidad_medida')->get();

        $c_comunidades = count($comunidades);

        $registros = Produccion_comunidad::where('comunidad_id', $s_comunidad)
            ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
            ->where('comunidades.municipio_id', $s_municipio)
            ->orderBy('cantidad_produccion', 'desc')
            ->get();

        return view('admin.home', compact(
            'municipios',
            'comunidades',
            'categorias',
            'productos',
            'um_produccion',
            'registros',
            's_comunidad',
            's_municipio',
            's_categoria',
            's_producto',
            'c_comunidades'
        ));
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

        $aprox_kg = $request->cantidad_produccion * $request->equivalencia;
        $aprox_tnl = ($aprox_kg / 1000);
        $porcent_total = $request->autoconsumo + $request->desperdicio + $request->ventas;
        $autocons_total = $aprox_tnl * ($request->autoconsumo / 100);
        $desperdicio_total = $aprox_tnl * ($request->desperdicio / 100);
        $venta_total = $aprox_tnl * ($request->ventas / 100);

        Produccion_comunidad::create([
            'folio' => $request->folio,
            'comunidad_id' => $request->comunidad,
            'categoria_id' => $request->categoria,
            'producto_id' => $request->producto,
            'cantidad_produccion' => $request->cantidad_produccion,
            'um_produccion_id' => $request->um_produccion,
            'cantidad_terreno' => $request->cantidad_terreno,
            'um_terreno_id' => $request->um_terreno,
            'equivalencia_kg' => $request->equivalencia,
            'aprox_kg' => $aprox_kg, //---------------------------
            'aprox_toneladas' => $aprox_tnl,
            'comentario' => $request->comentario,
            'autoconsumo' => $request->autoconsumo,
            'desperdicio' => $request->desperdicio,
            'venta' => $request->ventas,
            'porcentaje_total' => $porcent_total, //----------
            'total_autoconsumo' => $autocons_total, //$request->total_autoconsumo,
            'total_desperdicio' => $desperdicio_total, // $request->total_desperdicio,
            'total_venta' => $venta_total // $request->total_venta
        ]);
        return redirect()->route('registro.index');
    }

    public function buscarPor(Request $request)
    {
        $s_municipio = $request->s_municipio;
        $s_comunidad = $request->s_comunidad;
        $s_categoria = $request->s_categoria;
        $s_producto = $request->s_producto;

        $municipios = Municipio::orderBy('id', 'asc')->get();
        $comunidades = Comunidad::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('categoria')->get();
        $productos = Producto::orderBy('nombre')->get();

        $um_produccion = Um_produccion::orderBy('unidad_medida')->get();
        $um_terreno = Um_terreno::orderBy('unidad_medida')->get();

        $c_comunidades = count($comunidades);
        
        return Categoria::find($s_categoria);


        $registros = Produccion_comunidad::where('comunidad_id', $s_comunidad)
            //->where('categoria_id',$request->s_categoria)
            ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
            ->where('comunidades.municipio_id', $s_municipio)
            //->or
            ->orderBy('cantidad_produccion', 'desc')
            ->get();

        return view('admin.home', compact(
            'municipios',
            'comunidades',
            'categorias',
            'productos',
            'um_produccion',
            'um_terreno',
            'registros',
            's_comunidad',
            's_municipio',
            's_categoria',
            's_producto',
            'c_comunidades'
        ));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtraComunidades(Request $request)
    {

        $municipio = $request->municipio;
        $comunidad = $request->comunidad;

        if ($comunidad == 0) {
            return redirect()->route('registro.show', $municipio);
        }

        $productos = Producto::all();
        $data = null;
        foreach ($productos as $value) {
            $datos = null;
            $datos['producto'] = $value;
            //-----------------------------------------------------------------------------------TOTAL TONELADAS
            $total_toneladas = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidad_id', $comunidad)
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
                ->where('comunidad_id', $comunidad)
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_autoconsumo');
            $datos['autoconsumo'] = $autoconsumo;

            //----------------------------------------------------------------------------------- DESPERDICIO
            $desperdicio = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidad_id', $comunidad)
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_desperdicio');
            $datos['desperdicio'] = $desperdicio;

            //----------------------------------------------------------------------------------- VENTA
            $venta = Produccion_comunidad::where('producto_id', $value->id)
                ->join('comunidades', 'comunidades.id', '=', 'produccion_comunidad.comunidad_id')
                ->where('comunidad_id', $comunidad)
                ->where('comunidades.municipio_id', $municipio)
                ->sum('total_venta');
            $datos['venta'] = $venta;
            $data[] = $datos;
            $nombres[] =  $value->nombre;
        }


        $municipios = Municipio::orderBy('nombre')->get();
        $comunidades = Comunidad::orderBy('nombre')->get();
        return view('admin.informes.informes', compact('data', 'municipio', 'comunidad', 'municipios', 'comunidades'));
    }


    public function show($id)
    {
        $municipio = $id;
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
            $comunidad = 0;
            $nombres[] =  $value->nombre;
        }
        $municipios = Municipio::orderBy('nombre')->get();
        $comunidades = Comunidad::orderBy('nombre')->get();
        return view('admin.informes.informes', compact('data', 'municipio', 'comunidad', 'municipios', 'comunidades'));
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
        $aprox_kg = $request->cantidad_produccion * $request->equivalencia;
        $aprox_tnl = ($aprox_kg / 1000);
        $porcent_total = $request->autoconsumo + $request->desperdicio + $request->ventas;
        $autocons_total = $aprox_tnl * ($request->autoconsumo / 100);
        $desperdicio_total = $aprox_tnl * ($request->desperdicio / 100);
        $venta_total = $aprox_tnl * ($request->ventas / 100);

        $registro = Produccion_comunidad::find($id);

        $registro->folio = $request->folio;
        $registro->comunidad_id = $request->comunidad;
        $registro->categoria_id = $request->categoria;
        $registro->producto_id = $request->producto;
        $registro->cantidad_produccion = $request->cantidad_produccion;
        $registro->um_produccion_id = $request->um_produccion;
        $registro->cantidad_terreno = $request->cantidad_terreno;
        $registro->um_terreno_id = $request->um_terreno;
        $registro->equivalencia_kg = $request->equivalencia;
        $registro->aprox_kg = $aprox_kg; //---------------------------
        $registro->aprox_toneladas = $aprox_tnl;
        $registro->comentario = $request->comentario;
        $registro->autoconsumo = $request->autoconsumo;
        $registro->desperdicio = $request->desperdicio;
        $registro->venta = $request->ventas;
        $registro->porcentaje_total = $porcent_total; //----------
        $registro->total_autoconsumo = $autocons_total; //$request->total_autoconsumo;
        $registro->total_desperdicio = $desperdicio_total; // $request->total_desperdicio;
        $registro->total_venta = $venta_total; // $request->total_venta

        $registro->save();

        return redirect()->route('registro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Produccion_comunidad::find($id)->delete();
        return redirect()->route('registro.index')->with('eliminar', 'ok');
    }

    public function importRegister(Request $request)
    {

        $file = $request->file('file');

        Excel::import(new RegistrosImport, $file);
        return redirect()->route('registro.index');
    }

    public function cambiar(Request  $reques)
    {
        $element = Comunidad::where('municipio_id', 1)->get();
        $list = "";
        foreach ($element as  $value) {
            echo $list . '<option value="' . $value->id . '">' . $value->nombre . '</option>';
        }
    }
}
