<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
//    public function index()
//     {
//         return view('user.dashboard');
//     }
// }

public function index()
    {
        if(Auth::check()){
            return view('user.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }