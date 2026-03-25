<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Show form
    public function index()
    {
        return view('contact');
    }

    // Save form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'subject' => 'required|max:100',
            'message' => 'required|min:10'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success','Message sent successfully!');
    }
}