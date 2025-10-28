<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class UserController extends Controller
{
    public function dashboard()
    {   $highlightedMessage = session('contact_id')
    ? Contact::find(session('contact_id'))
    : null;
        $user = Auth::user();

        $messages = Contact::where('user_id', $user->id)->latest()->get();

       return view('dashboard', compact('user', 'messages', 'highlightedMessage'));
    }
}