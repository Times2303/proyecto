<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parroquias extends Model
{
    protected $table = 'parroquias';

    public function sacerdotes()
    {
        return $this->hasMany(Sacerdotes::class, 'parroquia_id');
    }

    public function ceremonias()
{
    return $this->hasMany(Ceremonias::class, 'parroquias_id');
}
}
