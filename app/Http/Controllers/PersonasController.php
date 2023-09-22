<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Cache\RedisStore;
use Illuminate\Http\Request;

// Importar Clase para Eliminar
use Illuminate\Support\Facades\Storage;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Presentacio de los datos
        $datos['PersonasL']=Personas::paginate(5);
        return view('personas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // accede a la Vista 
        return view ('personas.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        // Se reciben los datos del formulario create.blade.php
        //$datosPersona = request()->all();
        $datosPersona = request()->except('_token');

        // Validar el Archivos y guardar en el File Server del Site
        // se Guarda en la Ruta de la Aplicacion/storage/app/public/uploads

        if($request->hasFile('Foto')){
            $datosPersona['Foto']=$request->file('Foto')->store('uploads','public');
        }

        if($request->hasFile('hoja_vida')){
            $datosPersona['hoja_vida']=$request->file('hoja_vida')->store('uploads','public');
        }

        // Inserta la informacion exepto el _token
        Personas::insert($datosPersona);

        //return response()->json($datosPersona);
        return redirect('personas')->with('mensaje','Registro Creado Exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Personas $personas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Function para Retornar la Vista y Editar los datos
        $personasE=Personas::findOrFail($id);
        return view('personas.edit', compact('personasE'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Funion para Actualizacion
        $datosPersona = request()->except(['_token', '_method']);

        // Validar el Archivos y guardar en el File Server del Site
        // se Guarda en la Ruta de la Aplicacion/storage/app/public/uploads

        if($request->hasFile('Foto')){
            // Eliminacion del Archivo Anterior
            $personasE=Personas::findOrFail($id);
            Storage::delete('public/'.$personasE->foto);

            $datosPersona['Foto']=$request->file('Foto')->store('uploads','public');
        }

        if($request->hasFile('hoja_vida')){
            // Eliminacion del Archivo Anterior
            $personasE=Personas::findOrFail($id);
            Storage::delete('public/'.$personasE->hoja_vida);

            $datosPersona['hoja_vida']=$request->file('hoja_vida')->store('uploads','public');
        }

        // Actualizacion
        Personas::where('id','=',$id)->update($datosPersona);    


        // Retorna al Formulario
        //return $this->index();        
        return redirect('personas')->with('mensaje','Registro Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Function para Eliminar el Archivo de la Imagen
        $personasE=Personas::findOrFail($id);
        storage::delete('public/'.$personasE->foto);
        storage::delete('public/'.$personasE->hoja_vida);

        // Function para Eliminar Registro
        personas::destroy($id);
        //return redirect('personas');
        return redirect('personas')->with('mensaje','Registro Eliminado Exitosamente');
    }

}
