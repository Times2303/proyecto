<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use App\Models\TiposIdentificacion;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
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
        $modo = 'personas';
        $buscar = request('buscar');
        $tiposidentificaciones = TiposIdentificacion::all();
        $nacionalidades = Nacionalidad::all();
        $personas = $this->webController->obtenerPersonasFiltradas($buscar);
        $total = DB::select('select fn_total_personas() as total')[0]->total;
        return view('modules.personas.InicioPersonas', compact('tiposidentificaciones', 'nacionalidades', 'personas', 'total', 'modo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposidentificaciones = TiposIdentificacion::all();
        $nacionalidades = Nacionalidad::all();
        return view('modules.personas.CreatePersonas', compact('tiposidentificaciones', 'nacionalidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::select('call insertar_persona(?,?,?,?,?,?,?,?,?,?)', [
                $request->input('nombres'),
                $request->input('apellido1'),
                $request->input('apellido2'),
                $request->input('email'),
                $request->input('fecha_nacimiento'),
                $request->input('direccion'),
                $request->input('celular'),
                $request->input('tipo_identificacion'),
                $request->input('nacionalidad'),
                $request->input('num_identificacion')
            ]);
            return redirect()->route('personas.index')->with('success', 'Se creó correctamente.');
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
        $persona = Personas::findOrFail($id);
        $tiposidentificaciones = TiposIdentificacion::all();
        $nacionalidades = Nacionalidad::all();
        return view('modules.personas.EditPersonas', compact('persona', 'tiposidentificaciones', 'nacionalidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::select('call actualizar_persona(?,?,?,?,?,?,?,?,?,?,?)', [
                $request->input('nombres'),
                $request->input('apellido1'),
                $request->input('apellido2'),
                $request->input('email'),
                $request->input('fecha_nacimiento'),
                $request->input('direccion'),
                $request->input('celular'),
                $request->input('tipo_identificacion'),
                $request->input('nacionalidad'),
                $request->input('num_identificacion'),
                $id
            ]);
            return redirect()->route('personas.index')->with('success', 'Se actualizó correctamente.');
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
        $persona = Personas::findOrFail($id);
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente.');
    }
}
