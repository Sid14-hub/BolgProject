<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('blogPosts.blog', compact('posts'));
    }
    public function show($slug)
    {   $post = Post::where('slug',$slug)->first();
        return view('blogPosts.single-blog-post',compact('post'));
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

       $title = $req->input('title');
       $slug =  Str::slug($title,'-');
       $user_id  = Auth::user()->id;
       $body = $req->input('body');
       $imagePath = 'storage/'.$req->file('image')->store('postsImages','public');

       $post = new Post();
       $post->title = $title;
       $post->slug = $slug;
       $post->user_id = $user_id;
       $post->body = $body;
       $post->imagePath = $imagePath;

       $post->save();
       return redirect()->back()->with('status','Post Created Successfully');
    }
}
