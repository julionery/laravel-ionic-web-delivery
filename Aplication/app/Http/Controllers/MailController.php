<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;

class MailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mail::send('emails.contact', $request->all(), function ($msj){
            $msj->subject('Nova Mensagem - Site Os PrintF');
            $msj->to('julio_cesar.an@hotmail.com');
        });
        Session::flash('message', 'Enviado com sucesso!');
        return Redirect::to('/');
        dd($request);
    }

}
