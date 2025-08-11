<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jerarquias extends Model
{
    protected $table = 'jerarquias';
    public function sacerdotes()
    {
        return $this->hasMany(Sacerdotes::class, 'jerarquias_id');
    }
}
