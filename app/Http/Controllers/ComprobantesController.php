<?php

namespace App\Http\Controllers;

use App\Models\Comprobantes;
use Illuminate\Http\Request;
use App\Models\Personas;
use Illuminate\Support\Facades\DB;

class ComprobantesController extends Controller
{
    protected $webController;

    public function __construct()
    {
        $this->webController = new WebController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comprobantes = Comprobantes::with('persona')->get();
        return view('modules.comprobantes.InicioComprobantes', compact('comprobantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $persona = null;
        if (request()->has('persona_id')) {
            $persona = Personas::findOrFail($request->persona_id);
        }
        return view('modules.comprobantes.CreateComprobante', compact('persona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Generar número correlativo automático
            $ultimo = Comprobantes::orderBy('id', 'desc')->first();
            $numero = $ultimo ? intval($ultimo->numero_comprobante) + 1 : 1;
            // Rellenar con ceros a la izquierda hasta 10 dígitos
            $numero = str_pad($numero, 10, '0', STR_PAD_LEFT);

            DB::select('call insertar_comprobante(?,?,?,?)', [
                $numero,
                $request->input('monto'),
                $request->input('fec_pago'),
                $request->input('persona_id')
            ]);
            return redirect()->route('comprobantes.index')->with('success', 'Se creó correctamente.');
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
        $comprobante = Comprobantes::with('persona')->findOrFail($id);
        return view('modules.comprobantes.EditComprobante', compact('comprobante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            DB::select('call actualizar_comprobante(?,?,?)', [
                $request->input('monto'),
                $request->input('fec_pago'),
                $id
            ]);
            return redirect()->route('comprobantes.index')->with('success', 'Se actualizó correctamente.');
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
        $comprobante = Comprobantes::findOrFail($id);
        $comprobante->delete();

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado correctamente.');
    }

    public function seleccionar()
    {
        $modo = 'comprobante';
        $buscar = request('buscar');
        $personas = $this->webController->obtenerPersonasFiltradas($buscar);
        return view('modules.personas.InicioPersonas', compact('modo', 'personas'));
    }
}
