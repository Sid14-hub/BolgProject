@extends('layout')
@section('js')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
@endsection
@section('main')
    <main class="container" style="background-color: #fff;">
        <section id="contact-us">
            <h1 style="padding-top: 50px;">Create New Post!</h1>
            <!-- Contact Form -->
            <div class="contact-form">
                <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <label for="title"><span>Title</span></label>
                    <input type="text" id="title" name="title" value="{{old('title')}}" />
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
                    <textarea id="body" name="body">{{old('body')}}</textarea>
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