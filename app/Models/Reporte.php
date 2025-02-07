<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'fecha', 
        'hora', 
        'nombre_camara', 
        'incidente', 
        'descripcion',
        'status'
    ];
}
