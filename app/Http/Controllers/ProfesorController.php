<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::all();
        return view('profesores.mostrarProfesores', ['profesores' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesores.altaProfesor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:profesores,email',
            'telefono' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validación es exitosa, almacenar el profesor en la base de datos
        Profesor::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        // Redirigir a una ruta después de almacenar el profesor (opcional)
        return redirect()->route('profesores.index')->with('success', 'Profesor creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesor::find($id);
        return view('profesores.editarProfesor', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validamos los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:profesores,nombre,'.$id,
            'email' => 'required|email|unique:profesores,email,'.$id,
            'telefono' => 'nullable|string|max:20',
        ]);
    
        // Actualizamos el profesor en la base de datos
        $profesor = Profesor::find($id);
        $profesor->nombre = $request->nombre;
        $profesor->email = $request->email;
        $profesor->telefono = $request->telefono;
        $profesor->save();
    
        // Redirigimos a la vista de detalle del profesor o a cualquier otra vista que desees
        return view('profesores.menssage',['msg'=> "Registro Correctamente Actualizado"]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
    
        return view('profesores.menssage',['msg'=> "Se Elimino Correctamente El Registro"]);
    }
    
}
