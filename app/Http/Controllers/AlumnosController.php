<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos; // Agrega esta línea para importar el modelo Alumno
use Illuminate\Support\Facades\Log;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumnos::all();
        return view('alumnos.edit_axios', ['alumnos' => $alumnos]);
    }
    
    
  
    
    public function buscar(Request $request)
    {
        $texto = $request->input('texto'); // Obtener el texto de la solicitud
        // Obtener la primera letra del texto ingresado
        $primera_letra = substr($texto, 0, 1);
        // Consulta para buscar por la primera letra del nombre o matrícula
        $alumnos = Alumnos::where(function($query) use ($primera_letra) {
                $query->where('nombre', 'LIKE', $primera_letra . '%')
                      ->orWhere('matricula', 'LIKE', $primera_letra . '%');
            })
            ->orderBy('id', 'asc') // Ordenar por el campo 'id' de forma ascendente
            ->paginate(10);
        return response()->json($alumnos);
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('alumnos.create');
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
            'matricula'=> 'required|unique:alumnos|max:10',
            'nombre' => 'required|max:255',
            'fecha'=>'required|date',
            'telefono' =>'required',
            'email'=> 'nullable|email'
        ]);

        Alumnos::create([
            'matricula' => $request->input('matricula'),
            'nombre' => $request->input('nombre'),
            'fecha_nacimiento' => $request->input('fecha'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email')
        ]);

        return view("alumnos.menssage",['msg'=> "Registro guardado"]); //Este reurn va a mostrar un msn cuando el regsitra
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
        $alumno=Alumnos::find($id);
        $a=['alumno' => $alumno];
        return view('alumnos.edit',$a);
        
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
        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,'.$id,//Se esta agregando una excepcion  de que se va omitir la validacion de la matricula si el id pertenece al registro
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
        ]);
        
//Los input se encapsula en un request se accede de esta manera $request->input
        $alumno=Alumnos::find($id);
        $alumno->matricula= $request->input('matricula');
        $alumno->nombre= $request->input('nombre');
        $alumno->fecha_nacimiento= $request->input('fecha');
        $alumno->telefono= $request->input('telefono');
        $alumno->email= $request->input('email');
        $alumno->save();
        return view("alumnos.menssage",['msg'=> "Registro Correctamente Actualizado"]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno= Alumnos::find($id);
        $alumno->delete();

        return view("alumnos.menssage",['msg'=> "Registro Correctamente Borrado"]);
        //
    }
}
