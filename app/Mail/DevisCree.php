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

    $pdfPath = storage_path("app/{$this->devis->pdf_path}");

    return $this->subject('Merci pour votre devis chez Lexpertimmobilier')
                ->attach($pdfPath, [
                    'as' => 'Votre_devis_Lexpertimmobilier.pdf',
                    'mime' => 'application/pdf',
                ])
                ->markdown('emails.devis.cree')
                ->with([
                    'user' => $user,
                    'devis' => $this->devis,
                    'messagePerso' => "Bonjour {$user->name}, merci pour votre demande. Vous trouverez ci-joint votre devis personnalisé.",
                    'dateDevis' => $this->devis->created_at->format('d/m/Y à H:i'),
                    'dashboardUrl' => route($user->role === 'Admin' ? 'Admin.dashboard_Admin' : 'user.dashboard', ['id' => $user->id]),
                ]);
}
}
