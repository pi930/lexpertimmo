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
                        'rendezvousUrl' => route('rendezvous.index', ['user' => $user->id]),
                    ]);
    }
}