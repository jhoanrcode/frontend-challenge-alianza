<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleados::orderBy('id', 'desc')->paginate(6);
        return Inertia::render('Empleados/Index', [
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
            'nombre' => 'required|max:255',
            'identificacion' => 'required|unique:empleados|min_digits:4|max_digits:10',
            'direccion' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'telefono' => 'required|min_digits:4|max_digits:10',
        ]);

        try {
            $new_empleado = Empleados::create( $request->input() ); 
            return redirect('empleados');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleados $empleados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empleados = Empleados::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:255',
            'identificacion' => ['required', 'min_digits:4|max_digits:10', Rule::unique('empleados')->ignore($empleados)],
            'direccion' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'telefono' => 'required|min_digits:4|max_digits:10',
        ]);

        try {
            $empleados->update( $request->input() );
            return redirect('empleados');
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
            $empleado = Empleados::findOrFail($id)->delete();
            return redirect('empleados');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }
}
