<h2>Répondre à {{ $user->nom }}</h2>
<p>Message original : {{ $message->contenu }}</p>

<form action="{{ route('send.reply', $message->id) }}" method="POST">
    @csrf
    <input type="hidden" name="contact_id" value="{{ $message->id }}">
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <input type="hidden" name="admin" value="{{ $admin }}">

    <textarea name="reponse" class="w-full border p-2" rows="5" placeholder="Votre réponse..."></textarea>
    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2">Envoyer</button>
</form>