<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogPosts.blog');
    }
    public function show()
    {
        return view('blogPosts.single-blog-post');
    }
    public function create()
    {
        return view('blogPosts.create');
    }
    public function store(Request $req)
    {
       $req->validate([
           'title' => 'required',
           'image' => 'required | image',
           'body' => 'required'
       ]);
       dd('passed');
    }
}
