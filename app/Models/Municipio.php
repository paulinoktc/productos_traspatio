<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;


    protected $table = 'municipios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre'];
    public $timestamps = false;
    public function comunidades()
    {
        return $this->hasMany(Comunidad::class);
    }
    
}
