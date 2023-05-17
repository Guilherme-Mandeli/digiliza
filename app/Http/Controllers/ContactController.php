<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function sendEmail(ContactRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ];

        Mail::to('guil.mandeli@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'E-mail enviado com sucesso!')->withFragment('contact');
    }
}
