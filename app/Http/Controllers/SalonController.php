<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use Illuminate\Support\Facades\Validator;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salones = Salon::all();
        return view('aulas.mostrarAulas', ['salones' => $salones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aulas.altaAula');
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
            'nombre' => 'required|string|max:255|unique:salones,nombre',
        ]);
        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Almacenar el aula en la base de datos
        Salon::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('aulas.index')->with('success', 'Aula creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $salon)
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
        $salon = Salon::find($id);
        return view('aulas.editarAula', compact('salon'));
        
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
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:salones,nombre,'.$id.',id',
        ]);
    
        // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Actualizar el aula en la base de datos
        $salon = Salon::find($id);
    
        // Comprobar si el aula existe
        if (!$salon) {
            return redirect()->back()->with('error', 'Aula no encontrada');
        }
    
        // Actualizar los datos del aula
        $salon->nombre = $request->nombre;
        $salon->save();
    
        // Comprobar si la actualización fue exitosa
        if (!$salon->wasChanged()) {
            return redirect()->back()->with('warning', 'No se realizó ninguna actualización');
        }
    
        // Redireccionar a la vista de detalle del aula o a cualquier otra vista que desees
        return redirect()->route('aulas.index')->with('success', 'Registro actualizado correctamente');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salon = Salon::findOrFail($id);
        $salon->delete();

        return view('aulas.menssage',['msg'=> "Registro eliminado correctamente",'ruta'=>"aulas.index"]);
    }
}
