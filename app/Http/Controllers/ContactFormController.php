<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Votre message a bien été envoyé.');
    }
}
