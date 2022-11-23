<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Produccion_comunidad;
use App\Models\Producto;
use App\Models\Um_produccion;
use App\Models\Um_terreno;
use Maatwebsite\Excel\Concerns\ToModel;

class RegistrosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if ($row[0] == null) {
            $row[0] = 0;
        }
       
        if ($row[4] == null) {
            $row[4] = 0;
        }
        if ($row[6] == null) {
            $row[6] = 0;
        }
        if ($row[8] == null) {
            $row[8] = 0;
        }
        if ($row[10] == null) {
            $row[10] = 0;
        }
        if ($row[11] == null) {
            $row[11] = 0;
        }

        $aprox_kg = $row[3] * $row[7];
        $aprox_tnl = ($aprox_kg / 1000);
        $porcent_total = ($row[9] + $row[10] + $row[11]) * 100; //cuando las entradas son decimales
        $autocons_total = $aprox_tnl * ($row[9]); // / 100);
        $desperdicio_total = $aprox_tnl * ($row[10]); // / 100);
        $venta_total = $aprox_tnl * ($row[11]); /// 100);

        $comunidad = Comunidad::where('nombre', 'LIKE', '%' . $row[1] . '%')->max('id');
        //$categoria = Categoria::where('categoria', 'LIKE', '%' . $row[2] . '%')->max('id');
        $producto = Producto::where('nombre', 'LIKE', '%' . $row[2] . '%')->max('id');
        $unidad_m_prod = Um_produccion::where('unidad_medida', 'LIKE','%' .$row[4].'%')->max('id');
        $unid_m_terr = Um_produccion::where('unidad_medida', 'LIKE', '%' .$row[6].'%')->max('id');


        return new Produccion_comunidad([
            'folio' => $row[0],
            'comunidad_id' => $comunidad, //$row[1]
            //'categoria_id' => $categoria, //$row[2],
            'producto_id' => $producto, //$row[2],
            'cantidad_produccion' => $row[3],
            'um_produccion_id' => $unidad_m_prod, // $row[4],
            'cantidad_terreno' => $row[5],
            'um_terreno_id' => $unid_m_terr, // $row[6],
            'equivalencia_kg' => $row[7],
            'aprox_kg' => $aprox_kg, //---------------------------
            'aprox_toneladas' => $aprox_tnl,
            'comentario' => $row[8],
            'autoconsumo' => $row[9] * 100,
            'desperdicio' => $row[10] * 100,
            'venta' => $row[11] * 100,
            'porcentaje_total' => $porcent_total, //----------autoconsumo + desperdicio + ventas
            'total_autoconsumo' => $autocons_total, //$row[]->total_autoconsumo,
            'total_desperdicio' => $desperdicio_total, // $row[]->total_desperdicio,
            'total_venta' => $venta_total // $row[]->total_venta
        ]);
    }
}
