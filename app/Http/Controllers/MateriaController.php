<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia; // Agrega esta línea para importar el modelo Alumno
use Illuminate\Support\Facades\Log;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::all();
        return view('materias.mostrarMaterias', ['materias' => $materias]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('materias.altaMateria');
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
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255'
        ]);

        Materia::create([
           
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion')
            
        ]);

        return view("materias.menssage",['msg'=> "Registro guardado"]); //Este reurn va a mostrar un msn cuando el regsitra
        //se haya guardado correctamente para esto se crea otra vista menssage.blade.php

        //
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
        $materias=Materia::find($id);
        $a=['materias' => $materias];
        return view('materias.editarMateria',$a);
        
        //
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255'
        ]);
        
        // Encontrar la materia por su ID
        $materia = Materia::findOrFail($id);
        
        // Actualizar los campos de la materia con los nuevos valores de la solicitud
        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        
        // Guardar los cambios en la base de datos
        $materia->save();
        
        // Redirigir a una vista con un mensaje de éxito
        return view("materias.menssage", ['msg' => "Registro Actualizado Correctamente"]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia= Materia::find($id);
        $materia->delete();

        return view("materias.menssage",['msg'=> "Registro Correctamente Borrado"]);
        //
    }
}
