<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'rue' => 'required|string|max:255',
            'code_postal' => ['required', 'regex:/^\d{5}$/'],
            'ville' => 'required|string|max:100',
            'pays' => 'required|string|max:100',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Si l'utilisateur est connecté, on peut ajouter son ID ou autre info
        if (Auth::check()) {
            $validated['user_id'] = Auth::id(); // à condition que la table Contact ait une colonne user_id
        }

        Contact::create($validated);

        return redirect()->route('contact.show')->with('success', 'Votre message a bien été enregistré.');
    }

    // Accessible uniquement aux admins
    public function index()
    {
        // Tu peux ajouter une vérification de rôle ici si besoin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $messages = Contact::latest()->paginate(20);
        return view('admin.contact.index', compact('messages'));
    }
}