<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WebController;
use App\Models\Jerarquias;
use App\Models\Nacionalidad;
use App\Models\Parroquias;
use App\Models\Sacerdotes;
use App\Models\Personas;
use App\Models\TiposIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SacerdotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $webController;

    public function __construct()
    {
        $this->webController = new WebController();
    }
    public function index()
    {
        
        $buscar = request('buscar');
        $sacerdote = $this->webController->obtenerSacerdotesFiltrados($buscar);
        $total = DB::select('select fn_total_sacerdotes() as total')[0]->total;
        return view('modules.sacerdotes.InicioSacerdotes', compact('sacerdote', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $parroquia = Parroquias::all();
        $jerarquia = Jerarquias::all();
        session()->flash('info', 'La fecha de retiro no es obligatoria si se desconoce.'); //mostrar el toast
        return view('modules.sacerdotes.CreateSacerdotes', compact('parroquia', 'jerarquia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::select('call insertar_sacerdote(?,?,?,?,?)', [
                $request->input('fec_inicio'),
                $request->input('fec_fin'),
                $request->input('persona_id'),
                $request->input('jerarquia'),
                $request->input('parroquia')
            ]);
            return redirect()->route('sacerdotes.index')->with('success', 'Se creó correctamente.');
        } catch (\Throwable $th) {
            $mensaje = $this->webController->formatearError($th->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sacerdote = Sacerdotes::findOrFail($id);
        $parroquia = Parroquias::all();
        $jerarquia = Jerarquias::all();
        return view('modules.sacerdotes.EditSacerdotes', compact('sacerdote', 'parroquia', 'jerarquia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::select('call actualizar_sacerdote(?,?,?,?,?)', [
                $request->input('fec_inicio'),
                $request->input('fec_fin'),
                $request->input('jerarquia'),
                $request->input('parroquia'),
                $id
            ]);
            return redirect()->route('sacerdotes.index')->with('success', 'Se actualizó correctamente.');
        } catch (\Throwable $th) {
            $mensaje = $this->webController->formatearError($th->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sacerdote = Sacerdotes::findOrFail($id);
        $sacerdote->delete();

        return redirect()->route('sacerdotes.index')->with('success', 'Sacerdote eliminado correctamente.');
    }
    
    public function seleccionar()
    {
        session()->forget('info'); // Limpiar la sesión de información Laravel guarda ese mensaje en la sesión solo por la próxima solicitud.
                                    // Si el usuario hace clic en "Volver", y Laravel no ha consumido el mensaje flash, entonces el mensaje sigue activo y se vuelve a mostrar.
        $modo = 'sacerdote';
        $buscar = request('buscar');
        $personas = $this->webController->obtenerPersonasFiltradas($buscar);
        $total = DB::select('select fn_total_personas() as total')[0]->total;
        return view('modules.personas.InicioPersonas', compact('modo', 'personas', 'total'));
    }

}
