<?php
namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Coordonnees extends Component
{
    public $coordonnees;
    public $isAdmin;
    public $user;

    public function __construct($coordonnees = null, $isAdmin = false, $user = null)
    {
        $this->coordonnees = $coordonnees;
        $this->isAdmin = $isAdmin;
        $this->user = $user;
    }

    public function render()
    {
        return view('components.dashboard.coordonnees');
    }
}