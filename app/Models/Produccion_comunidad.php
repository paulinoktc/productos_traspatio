<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produccion_comunidad extends Model
{
    use HasFactory;

    protected $table = 'produccion_comunidad';
    protected $primarykey = 'id';
    protected $fillable = [
        'folio',
        'comunidad_id',
        'categoria_id',
        'producto_id',
        'cantidad_produccion',
        'um_produccion_id',
        'cantidad_terreno',
        'um_terreno_id',
        'equivalencia_kg',
        'aprox_kg',
        'aprox_toneladas',
        'comentario',
        'autoconsumo',
        'desperdicio',
        'venta',
        'porcentaje_total',
        'total_autoconsumo',
        'total_desperdicio',
        'total_venta'
    ];
    public $timestamps = false;

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function um_terreno()
    {
        return $this->belongsTo(Um_terreno::class);
    }
    public function um_produccion()
    {
        return $this->belongsTo(Um_produccion::class);
    }
    
    
}
