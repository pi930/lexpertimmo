<?PHP
namespace App\Mail;

use App\Models\Devis;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DevisCree extends Mailable
{
    use Queueable, SerializesModels;

    public $devis;

    public function __construct(Devis $devis)
    {
        $this->devis = $devis;
    }
    

public function build()
{
    $user = $this->devis->user;

    if (!$user) {
        throw new \Exception("L'utilisateur lié au devis est introuvable.");
    }

    $pdfPath = Storage::disk('devis_private')->path($this->devis->pdf_path);

    // URL ABSOLUE obligatoire pour mail::button
    $dashboardUrl = route('user.dashboard', ['id' => $user->id], true);

    return $this->subject('Merci pour votre devis chez Lexpertimmobilier')
                ->attach($pdfPath, [
                    'as' => 'Votre_devis_Lexpertimmobilier.pdf',
                    'mime' => 'application/pdf',
                ])
                ->markdown('emails.devis.cree')
                ->text('emails.devis.cree_plain')
                ->with([
                    'user' => $user,
                    'devis' => $this->devis,
                    'messagePerso' => "Bonjour {$user->nom}, merci pour votre demande. Vous trouverez ci-joint votre devis personnalisé.",
                    'dateDevis' => $this->devis->created_at->format('d/m/Y à H:i'),
                    'dashboardUrl' => $dashboardUrl,
                ]);
}

}
