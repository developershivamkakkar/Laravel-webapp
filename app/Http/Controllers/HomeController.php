<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $data['services'] = $services;

        return view('home',$data);
    }


    public function about()
    {

        return view('about');
    }
}
