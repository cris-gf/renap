<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Request as  ModelRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;
use Illuminate\Support\Facades\Storage;
use Mail;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create'); //Vista de formulario
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $password = substr(md5(rand()),0,8); //Autogenerar contraseña
        //Fotografía
        $picture = $request->cui.'.'.$request->image->extension();
        //Almacenar en proyecto
        $request->image->store('people', 'public');
        //Crear persona
        $person = Person::create(['password' => $password, "picture" => $picture] + $request->all()); //Campos de formulario+contraseña+fotografía

        //Crear solicitud
        $modelRequest = new ModelRequest();
        $modelRequest->person_id = $person->id; //Obtener id de persona
        $modelRequest->save();
        
        //Enviar correo
        $personArray = $person->toArray();
        $subject = "Envío de Contraseña"; //Asunto
        $receiver = $person->email; //Receptor
        Mail::send(
            'mails.email',
            $personArray,
            function($email) use($subject, $receiver)
            {
                $email->from("crisgon1065@gmail.com", "Administración Renap"); //Emisor
                $email->subject($subject); //Asunto
                $email->to($receiver); //Receptor
            }
        );
        
        //Regresar a formulario
        return back()->with('status', 'Solicitud Exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    public function getPeople() {
        $people = Person::all(); //Acceder a tabla
        $peopleArray = array(); //Inicializar para modificar

        foreach ($people as $person) {
            $request = Person::find($person->id)->request; //Estado de solicitud por cada persona
            $personArray  = $person->toArray();
            $personArray['status'] = $request->status; //Agregar estado de solicitud
            $peopleArray[] = $personArray; //Guardar datos con estado de solicitud de todas las personas 
        }
        //Enviar arreglo
        return response()->json($peopleArray);
    }
}
