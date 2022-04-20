<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

        protected $table = 'comunidades';
    protected $primarykey = 'id';
    protected $fillable = ['nombre', 'municipio_id'];
    public $timestamps = false;

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
