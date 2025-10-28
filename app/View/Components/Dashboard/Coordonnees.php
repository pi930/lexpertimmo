</php 
namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Coordonnees extends Component
{
    public $isAdmin;

    public function __construct($isAdmin = false)
    {
        $this->isAdmin = $isAdmin;
    }

    public function render()
    {
        return view('components.dashboard.coordonnees');
    }
}