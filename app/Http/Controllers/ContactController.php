<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactController extends Controller
{
    public function save(Request $request) { 
        @
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);
        $input = $request->only('name', 'email', 'message');
        try {
            Contact::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'message' => $input['message'],
            ]);

            // \Mail::send('contact_email',
            //  array(
            //      'name' => $request->get('name'),
            //      'email' => $request->get('email'),
            //      'user_message' => $request->get('message'),
            //  ), function($message) use ($request)
            //    {
            //       $message->from($request->email);
            //       $message->to('admin@example.com');
            //    });

            return redirect('/#Contactanos')->with('success', 'Se envió su mensaje correctamente!');
        } catch (\Exception $e) {
            dd($e);
            return redirect('/#Contactanos')->with('error', 'No fue posible enviar el mensaje!');
        }
    }
}
