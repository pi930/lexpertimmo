<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
            'pays' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Contact::create($validated);

        return redirect()->back()->with('success', 'Votre message a bien été envoyé.');
    }
}

