<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.dashboard');
        }

        return redirect("login")->with('error', 'You are not allowed to access.'); // You can use 'with' to display an error message
    }
}
