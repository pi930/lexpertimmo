<?php 
namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Coordonnees extends Component
{
    public $IsAdmin;

    public function __construct($IsAdmin = false)
    {
        $this->$IsAdmin;
    }

    public function render()
    {
        return view('components.dashboard.coordonnees');
    }
}