<?php
namespace App\View\Components;

use Illuminate\View\Component;

class DashboardDevis extends Component
{
    public $devis;
    public $admin;

    public function __construct($devis, $admin= false)
    {
        $this->devis = $devis;
        $this->admin= $admin;
    }

    public function render()
    {
        return view('components.dashboard-devis');
    }
}
