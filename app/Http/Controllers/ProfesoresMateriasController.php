<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Materia;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class ProfesoresMateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::with('materias')
        ->whereHas('materias')
        ->get();
    
    return view('profesorMateria.mostrarProfesorMatera', ['profesores' => $profesores]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profesores = Profesor::all();
        $materias = Materia::all();
    
    return view('profesorMateria.asignarMateria', compact('profesores', 'materias'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Buscar al profesor
    $profesor = Profesor::findOrFail($request->profesor_id);
    
    // Verificar si ya existe una relación entre el profesor y la materia
    $relacion = $profesor->materias()->where('materia_id', $request->materia_id)->first();

    if ($relacion) {
        // Si la relación existe, ver si está inactiva
        if (!$relacion->pivot->activo) {
            // Activar la relación existente
            $profesor->materias()->updateExistingPivot($request->materia_id, ['activo' => true]);
        } else {
            // Si la relación está activa, mostrar un mensaje indicando que ya está activa
            return redirect()->back()->with('error', 'La asignación de materia ya existe y está activa.');
        }
    } else {
        // Si la relación no existe, crear una nueva relación
        $profesor->materias()->attach($request->materia_id, ['activo' => true]);
    }

    // Mensaje de éxito
    return redirect()->route('asignarMateria.index')->with('success', 'Asignación de materia correctamente realizada.');
}

    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesores = Profesor::all();
        $materias = Materia::all();
        $materiaAsignada = $profesor->materias->first(); // Obtenemos la primera materia asignada al profesor (puedes ajustarlo según tus necesidades)
    
        return view('profesorMateria.edit', compact('profesor', 'profesores', 'materias', 'materiaAsignada'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profesor_id' => 'required|exists:profesores,id',
            'materia_id' => [
                'required',
                'exists:materias,id',
                Rule::unique('profesor_materia')->where(function ($query) use ($request) {
                    return $query->where('profesor_id', $request->profesor_id);
                })->whereNotIn('materia_id', (array) $request->materia_id)->ignore($id)
            ],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $profesor = Profesor::findOrFail($id);
    
        // Verificar si la materia ya está asignada a otro profesor
        $materiaAsignada = Materia::find($request->materia_id);
        $otrosProfesores = $materiaAsignada->profesores()->where('profesores.id', '!=', $id)->get();
    
        if ($otrosProfesores->isNotEmpty()) {
            return redirect()->back()->with('error', 'Esta materia ya está asignada a otro profesor.');
        }
    
        $profesor->materias()->sync($request->materia_id); // Utilizamos sync() para actualizar las relaciones Many-to-Many
    
        return redirect()->route('asignarMateria.index')->with('success', 'Asignación de materia actualizada correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar al profesor
        $profesor = Profesor::findOrFail($id);
    
        // Obtener todas las materias asociadas al profesor
        $materias = $profesor->materias;
    
        // Marcar todas las relaciones como inactivas
        foreach ($materias as $materia) {
            $profesor->materias()->updateExistingPivot($materia->id, ['activo' => false]);
        }
    
        // Redireccionar o volver a cargar la vista
        return redirect()->route('asignarMateria.index');
    }
    
    
}
