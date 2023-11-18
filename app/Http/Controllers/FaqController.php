<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
      $faq=Faq::OrderBy('created_at','DESC')->where('status',1)->get();
        $data['faq']=$faq;
        return view('faq', $data);
    }
}
