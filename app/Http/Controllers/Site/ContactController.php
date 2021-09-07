<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ContactSended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact');
    }

    public function sendEmail(Request $request)
    {
        Mail::to('gabrielbitti0@gmail.com')->send(new ContactSended($request));

        return back()->withSuccess('E-mail enviado com sucesso! Fique no aguardo do nosso contato.');
    }
}
