<?php

namespace App\Http\Controllers;

use App\Models\Parroquias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParroquiasController extends Controller
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
        $total = DB::select('select fn_total_parroquias() as total')[0]->total;
        $parroquia = Parroquias::all();
        return view('modules.parroquias.InicioParroquias', compact('parroquia', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.parroquias.CreateParroquias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::select('call insertar_parroquia(?,?,?,?)', [
                $request->nom_parroquia,
                $request->dir_parroquia,
                $request->lugar,
                $request->telefono
            ]);
            return redirect()->route('parroquias.index')->with('success', 'Se creó correctamente.');
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
        $parroquia = Parroquias::findOrFail($id);
        return view('modules.parroquias.EditParroquias', compact('parroquia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::select('call actualizar_parroquia(?,?,?,?,?)', [
                $request->nom_parroquia,
                $request->dir_parroquia,
                $request->lugar,
                $request->telefono,
                $id
            ]);
            return redirect()->route('parroquias.index')->with('success', 'Se actualizó correctamente.');
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
        $parroquia = Parroquias::findOrFail($id);
        $parroquia->delete();
        return redirect()->route('parroquias.index')->with('success', 'Se eliminó correctamente.');
    }
}
