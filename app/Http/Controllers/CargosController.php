<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = DB::table('cargo_empleados')
            ->join('empleados', 'cargo_empleados.id_empleados', '=', 'empleados.id')
            ->select('empleados.nombre', 'cargo_empleados.*')
            ->orderBy('cargo_empleados.id', 'desc')
            ->paginate(6);

        $empleados = DB::table('empleados')
            ->select('id as value','nombre as text')
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Cargos/Index', [
            'cargos' => $cargos,
            'empleados' => $empleados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_empleados' => 'required|unique:cargo_empleados',
            'cargo' => 'required|max:255',
            'jefe' => 'required|max:255',
        ]);

        try {
            $new_cargo = Cargos::create( $request->input() ); 
            return redirect('cargos');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cargos $cargos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cargos $cargos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cargo = Cargos::findOrFail($id);
        $request->validate([
            'id_empleados' => ['required', Rule::unique('cargo_empleados')->ignore($cargo)],
            'cargo' => 'required|max:255',
            'jefe' => 'required|max:255',
        ]);

        try {
            $cargo->update( $request->input() );
            return redirect('cargos');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cargo = Cargos::findOrFail($id)->delete();
            return redirect('cargos');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }
}
