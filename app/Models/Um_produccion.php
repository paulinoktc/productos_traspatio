<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Um_produccion extends Model
{
    use HasFactory;

    protected $table = 'um_produccion';
    protected $primarykey = 'id';
    protected $fillable = ['unidad_medida'];
    public $timestamps = false;
}
