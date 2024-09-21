<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact.contact');
    }

    public function addContact(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required|min:3|max:50|email',
            'subject' => 'required|min:3|max:50',
            'content' => 'required|min:3|max:100',
        ]);

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->content = $request->content;
        $contact->save();

        toastr()->success('Başarıyla gönderildi.');
        return redirect()->route('contact');
    }
}
