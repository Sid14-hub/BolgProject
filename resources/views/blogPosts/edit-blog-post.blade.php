@extends('layout')
@section('js')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
@endsection
@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 50px;">Edit Post!</h1>
            @if(session('status'))
                <p style="margin-bottom:20px;padding-top:20px;color:#fff;width:100%;height:50px;text-align:center;background:#5cb85c;">{{session('status')}}</p>
            @endif    
            <!-- Contact Form -->
            <div class="contact-form">
                <form action="{{route('blog.update', $post)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <!-- Title -->
                    <label for="title"><span>Title</span></label>
                    <input type="text" id="title" name="title" value="{{$post->title}}" />
                    @error('title')
                    <p style="color:red; margin-bottom:10px;">{{$message}}</p>
                    @enderror
                    <!-- Image -->
                    <label for="image"><span>Image</span></label>
                    <input type="file" id="image" name="image" />
                    @error('image')
                    <p style="color:red; margin-bottom:10px;">{{$message}}</p>
                    @enderror
                    <!-- Body-->
                    <label for="body"><span>Body</span></label>
                    <textarea id="body" name="body">{{$post->body}}</textarea>
                    @error('body')
                    <p style="color:red; margin:10px 0;">{{$message}}</p>
                    @enderror
                    <!-- Button -->
                    <input type="submit" value="Submit" />
                </form>
            </div>

        </section>
    </main>
@endsection
@section('scripts')
<script>
    CKEDITOR.replace( 'body' );
</script>
@endsection
