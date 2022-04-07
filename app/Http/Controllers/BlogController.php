<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }


    public function index(Request $req)
    {
        if($req->search){
            $posts = Post::where('title','like','%'.$req->search.'%')
            ->orwhere('title','like','%'.$req->search.'%')->latest()->get();
        }else{
            $posts = Post::latest()->get();
        }
        return view('blogPosts.blog', compact('posts'));
    }


    public function edit(Post $post){
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
        return view('blogPosts.edit-blog-post',compact('post'));
    }


    //Using route model binding
    public function show(Post $post){
        return view('blogPosts.single-blog-post',compact('post'));
    }
    
    public function destroy(Post $post){
        $post->delete();
        return redirect()->back()->with('status','Post Deleted Successfully');
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
       $postId = Post::latest()->take(1)->first()->id+1;
       $slug =  Str::slug($title,'-') . '-' . $postId;
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



    public function update(Request $req, Post $post){
        $req->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);
 
        $title = $req->input('title');
        $postId = $post->id;
        $slug =  Str::slug($title,'-') . '-' . $postId;
        $body = $req->input('body');
        $imagePath = 'storage/'.$req->file('image')->store('postsImages','public');
 
        
        $post->title = $title;
        $post->slug = $slug;
        $post->body = $body;
        $post->imagePath = $imagePath;
 
        $post->save();
        return redirect()->back()->with('status','Post Edited Successfully');
    }
}
