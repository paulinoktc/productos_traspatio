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

        $aprox_kg = $row[4] * $row[8];
        $aprox_tnl = ($aprox_kg / 1000);
        $porcent_total = ($row[10] + $row[11] + $row[12])*100;//cuando las entradas son decimales
        $autocons_total = $aprox_tnl * ($row[10]); // / 100);
        $desperdicio_total = $aprox_tnl * ($row[11]); // / 100);
        $venta_total = $aprox_tnl * ($row[12]); /// 100);

        $comunidad = Comunidad::where('nombre', 'LIKE', '%' . $row[1] . '%')->max('id');
        $categoria = Categoria::where('categoria', 'LIKE', '%' . $row[2] . '%')->max('id');
        $producto = Producto::where('nombre', 'LIKE', '%' . $row[3] . '%')->max('id');
        $unidad_m_prod = Um_produccion::where('unidad_medida', 'LIKE', '%' . $row[5] . '%')->max('id');
        $unid_m_terr = Um_terreno::where('unidad_medida', 'LIKE', '%' . $row[7] . '%')->max('id');

        if($categoria==null){
             $categoria=5;
        }


        return new Produccion_comunidad([
            'folio' => $row[0],
            'comunidad_id' => $comunidad, //$row[1]
            'categoria_id' => $categoria, //$row[2],
            'producto_id' => $producto, //$row[3],
            'cantidad_produccion' => $row[4],
            'um_produccion_id' => $unidad_m_prod, // $row[5],
            'cantidad_terreno' => $row[6],
            'um_terreno_id' => $unid_m_terr, // $row[7],
            'equivalencia_kg' => $row[8],
            'aprox_kg' => $aprox_kg, //---------------------------
            'aprox_toneladas' => $aprox_tnl,
            'comentario' => $row[9],
            'autoconsumo' => $row[10]*100,
            'desperdicio' => $row[11]*100,
            'venta' => $row[12]*100,
            'porcentaje_total' => $porcent_total, //----------autoconsumo + desperdicio + ventas
            'total_autoconsumo' => $autocons_total, //$row[]->total_autoconsumo,
            'total_desperdicio' => $desperdicio_total, // $row[]->total_desperdicio,
            'total_venta' => $venta_total // $row[]->total_venta
        ]);
    }
}
