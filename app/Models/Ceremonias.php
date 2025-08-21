<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ceremonias extends Model
{
    protected $table = 'ceremonias';
    public function parroquias()
    {
        return $this->belongsTo(Parroquias::class, 'parroquias_id');
    }
    public function sacerdotes()
    {
        return $this->belongsTo(Sacerdotes::class, 'sacerdotes_id');
    }
}
