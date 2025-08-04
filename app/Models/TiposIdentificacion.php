<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposIdentificacion extends Model
{
    protected $table = 'tipos_identificacion';
    //relaciones
    public function personas()
{
    return $this->hasMany(Personas::class, 'tipo_identificacion_id');
}

}
