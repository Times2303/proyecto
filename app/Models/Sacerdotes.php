<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sacerdotes extends Model
{
    protected $table = 'sacerdotes';
    public function personas()
    {
        return $this->belongsTo(Personas::class, 'personas_id');
    }
    public function jerarquias()
    {
        return $this->belongsTo(Jerarquias::class, 'jerarquias_id');
    }
    public function parroquias()
    {
        return $this->belongsTo(Parroquias::class, 'parroquias_id');
    }

    public function ceremonias()
    {
        return $this->hasMany(Ceremonias::class, 'sacerdotes_id');
    }

}
