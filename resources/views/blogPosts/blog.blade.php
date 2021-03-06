@extends('Layout')

@section('main')
<!-- main -->
<main class="container">
      <h2 class="header-title">All Blog Posts</h2>
      @if(session('status'))
                <p style="margin-bottom:20px;padding-top:20px;color:#fff;width:100%;height:50px;text-align:center;background:#5cb85c;">{{session('status')}}</p>
      @endif 
      <div class="searchbar">
        <form action="">
          <input type="text" placeholder="Search..." name="search" />

          <button type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      </div>
      <section class="cards-blog latest-blog">        
        @forelse($posts as $post)
        <div class="card-blog-content">
          @auth
          @if(auth()->user()->id === $post->user->id)
              <div class="post-buttons">
                <a href="{{route('blog.edit', $post)}}">Edit</a>
                <form action="{{route('blog.destroy', $post)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="submit" value="Delete">
                </form>
              </div>
            @endif
          @endauth
          <img src="{{asset($post->imagePath)}}" alt="" />
          <p>
            {{$post->created_at->diffForHumans()}}
            <span>Written By {{$post->user->name}}</span>
          </p>
          <h4>
            <a href="{{route('blog.show',$post)}}">{{$post->title}}</a>
          </h4>
        </div>
        @empty
        <p>Sorry, Not Found</p>
        @endforelse

        
      </section>
      <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
      </footer>
    </main>
@endsection