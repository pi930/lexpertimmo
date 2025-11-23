<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Coordonnees extends Component
{
    public $admin;
    public $user;

    public function __construct($user, $admin = false)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    public function render()
    {
        return view('components.dashboard.coordonnees');
    }
}
