<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre', 'precio_kg', 'cosechas', 'categoria_id'];
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
