<?php

namespace App\Http\Controllers;

use App\Models\Ceremonias;
use App\Models\Parroquias;
use App\Models\Sacerdotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CeremoniasController extends Controller
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
        $ceremonias = Ceremonias::with(['parroquias', 'sacerdotes.personas'])->get();
        return view('modules.ceremonias.InicioCeremonias', compact('ceremonias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parroquias = Parroquias::all();
        $sacerdotes = Sacerdotes::with('personas')->get();
        return view('modules.ceremonias.CreateCeremonias', compact('parroquias', 'sacerdotes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::select('call insertar_ceremonia(?,?,?,?)', [
                $request->input('fec_ceremonia'),
                $request->input('comentario'),
                $request->input('parroquia'),
                $request->input('sacerdote')
            ]);
            return redirect()->route('ceremonias.index')->with('success', 'Ceremonía registrada exitosamente.');
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
        $ceremonias = Ceremonias::findOrFail($id);
        $parroquias = Parroquias::all();
        $sacerdotes = Sacerdotes::with('personas')->get();
        return view('modules.ceremonias.EditCeremonias', compact('ceremonias', 'parroquias', 'sacerdotes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::select('call actualizar_ceremonia(?,?,?,?,?)', [
                $request->input('fec_ceremonia'),
                $request->input('comentario'),
                $request->input('parroquia'),
                $request->input('sacerdote'),
                $id
            ]);
            return redirect()->route('ceremonias.index')->with('success', 'Ceremonía actualizada exitosamente.');
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
        $ceremonias = Ceremonias::findOrFail($id);
        $ceremonias->delete();
        return redirect()->route('ceremonias.index')->with('success', 'Ceremonía eliminada exitosamente.');
    }
}
