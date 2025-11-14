<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IsAdminController extends Controller
{
    public function index()
    {
        return view('IsAdmin.dashboard_admin');
    }
}
