<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        // 1. Validation des champs
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Envoi du mail à votre adresse
        Mail::to('lifa96.kg@gmail.com')->send(new ContactMail($validated));

        // 3. Redirection avec un message de succès
        return redirect(url()->previous() . '#contact')
        ->with('success', 'Votre message a été envoyé avec succès !');
    }
}