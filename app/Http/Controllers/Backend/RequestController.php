<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\Person;
use Illuminate\Http\Request as HttpRequest;
use Mail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpRequest $request)
    {
        $requests = Request::get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HttpRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(HttpRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(HttpRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HttpRequest $request)
    {
        $id = $request->id; //Id de solicitud
        $status = $request->status; //Status actualizado de solicitud
        Request::where('id', $id)->update(array('status' => $status)); //Actualizar tabla

        $person = Request::find($id)->person; //Datos de persona
        if ($status == 'deliver') {
            //Enviar correo
            $personArray = $person->toArray();
            $subject = "Estado de Solicitud de DPI"; //Asunto
            $receiver = $person->email; //Receptor
            Mail::send(
                'mails.statusEmail',
                $personArray,
                function($email) use($subject, $receiver)
                {
                    $email->from("crisgon1065@gmail.com", "Administración Renap"); //Emisor
                    $email->subject($subject); //Asunto
                    $email->to($receiver); //Receptor
                }
            );
        }

        //Regresar a tabla
        return back()->with('status', "Solicitud de $person->name $person->last_name actualizada correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(HttpRequest $request)
    {
        //
    }
}
