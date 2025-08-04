<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidad';
    //relacion
    public function personas()
{
    return $this->hasMany(Personas::class, 'nacionalidad_id');
}

}
