<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = 'personas';
    //relaciones
    public function tipos_identificacion()
{
    return $this->belongsTo(TiposIdentificacion::class, 'tipo_identificacion_id');
}

public function nacionalidad()
{
    return $this->belongsTo(Nacionalidad::class, 'nacionalidad_id');
}

public function sacerdotes()
{
    return $this->hasMany(Sacerdotes::class, 'personas_id');
}
}
