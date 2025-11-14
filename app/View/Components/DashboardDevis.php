<?php
namespace App\View\Components;

use Illuminate\View\Component;

class DashboardDevis extends Component
{
    public $devis;
    public $IsAdmin;

    public function __construct($devis, $IsAdmin = false)
    {
        $this->devis = $devis;
        $this->IsAdmin= $IsAdmin;
    }

    public function render()
    {
        return view('components.dashboard-devis');
    }
}