<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(){
      $blogs=Blog::where('status',1)->orderBy('created_at','DESC')->get();
       $data['blogs']=$blogs;
        return view('blogs',$data);
    }



    public function detail($id){

       $blog= Blog::where('id',$id)->First();
       if ($blog==null) {
       return redirect()->route('blog.front');
       }
       $data['blog']=$blog;
     return view('blog-detail',$data);

    }
}






