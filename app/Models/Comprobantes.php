<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobantes extends Model
{
    protected $table = 'comprobantes';
    public function persona()
    {
        return $this->belongsTo(Personas::class, 'personas_id');
    }
}
