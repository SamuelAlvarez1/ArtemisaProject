<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::all();
        return view('contact.index', compact('messages'));
    }
    public function show($id)
    {
            $message = Contact::find($id);
            if ($message==null) {
                return back()->with('error', 'No se ha encontrado el mensaje');
            }
            $message->update(['read' => 1]);
            return view('contact.details', compact('message'));

    }
    public function save(Request $request) {
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
            return redirect('/#Contactanos')->with('success', 'Se envió su mensaje correctamente!');
        } catch (\Exception $e) {
            return redirect('/#Contactanos')->with('error', 'No fue posible enviar el mensaje!');
        }
    }
    public function lastMessages(){
        return Contact::latest()->take(2)->get();
    }
}
