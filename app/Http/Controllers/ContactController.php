use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactController extends Controller
{
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
    // Enregistrement dans la base 
    Contact::create($validated);
    // Redirection avec message de confirmation
    return redirect('/contact')->with('success', 'Votre message a bien été enregistré.');
 

}
 public function index()
{
    // Vérifie que l'utilisateur est bien un admin
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Accès interdit');
    }

    // Récupère tous les messages enregistrés, du plus récent au plus ancien
    $contacts = Contact::latest()->get();

    // Envoie les données à la vue Blade
    return view('messages', compact('contacts'));
}
}

    

