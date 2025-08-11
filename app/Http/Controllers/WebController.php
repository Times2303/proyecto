<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use App\Models\Sacerdotes;

class WebController extends Controller
{
    protected $paginate = 10;
    public function obtenerPersonasFiltradas($buscar)
    {
        return Personas::with('tipos_identificacion')
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('nombres', 'like', "%$buscar%")
                        ->orWhere('apellido1', 'like', "%$buscar%")
                        ->orWhere('apellido2', 'like', "%$buscar%")
                        ->orWhere('num_identificacion', 'like', "%$buscar%");
                });
            })
            ->paginate($this->paginate);
    }
    public function obtenerSacerdotesFiltrados($buscar)
    {
    return Sacerdotes::with(['personas.tipos_identificacion', 'personas.nacionalidad', 'jerarquias', 'parroquias'])
        ->when($buscar, function ($query, $buscar) {
            $query->whereHas('personas', function ($q) use ($buscar) {
                $q->where('nombres', 'like', "%$buscar%")
                    ->orWhere('apellido1', 'like', "%$buscar%")
                    ->orWhere('apellido2', 'like', "%$buscar%")
                    ->orWhere('num_identificacion', 'like', "%$buscar%");
            });
        })
        ->paginate($this->paginate);
    }

    public function formatearError($mensaje)
    {
        if (str_contains($mensaje, 'SQLSTATE')) {
                // Extrae solo el mensaje del trigger, antes de "(Connection:"
                preg_match('/\d{4} (.+?) \(Connection:/', $mensaje, $coincidencias);
                $mensaje = $coincidencias[1] ?? 'Ocurrió un error.';
            }
        return $mensaje;
    }
}
