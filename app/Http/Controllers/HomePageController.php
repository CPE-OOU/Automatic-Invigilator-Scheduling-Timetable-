<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    

   public function index()
    {
        // Add your logic for the home page here
        return view('home');
    }

    public function terms()
    {
        // Add your logic for the terms page here
        return view('terms');
    }

    public function service()
    {
        // Add your logic for the terms page here
        return view('service');
    }
    public function privacy()
    {
        // Add your logic for the privacy page here
        return view('privacy');
    }

    public function about()
    {
        // Add your logic for the about page here
        return view('about');
    }

    public function contact()
    {
        // Add your logic for the contact page here
        return view('contact');
    }

    public function faq()
    {
        // Add your logic for the FAQ page here
        return view('faq');
    }
}
