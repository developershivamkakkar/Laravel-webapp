<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Page;

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
        $page= Page::where('id',33)->first();
        return view('static-page',['page'=>$page]);
    }

    public function privacy(){
        $page= Page::where('id',37)->first();
        return view('static-page',['page'=>$page]);

    }

    public function terms(){
        $page= Page::where('id',34)->first();
        return view('static-page',['page'=>$page]);

    }

}




