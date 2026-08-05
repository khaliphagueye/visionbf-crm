<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterNotification;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.unique' => 'Cette adresse email est déjà inscrite.',
        ]);

        if ($validator->fails()) {
            return redirect('/#footer')
                ->withErrors($validator, 'newsletter')
                ->withInput();
        }

        $newsletter = Newsletter::create([
            'email' => $request->email
        ]);

        Mail::to('lifa96.kg@gmail.com')
            ->send(new NewsletterNotification($newsletter));

        return redirect('/#footer')->with(
            'newsletter_success',
            'Merci pour votre inscription.'
        );
    }
}
