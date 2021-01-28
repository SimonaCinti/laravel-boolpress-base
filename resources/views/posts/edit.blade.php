
@extends('layouts.main')

@section('content')
   <div class="container mb-4">
       <h1>Edit {{ $post->title }}</h1>

       @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>     
       @endif

        <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">    
            </div>

            <div class="form-group">
                <label for="body">Description</label>
                <textarea class="form-control" name="body" id="body">{{ old('body', $post->body) }}</textarea>   
            </div>

            <div class="form-group">
                <label for="path_img">Post Image</label>
                @isset($post->path_img)
                    <div class="wrap-image mb-5">
                        <img width="150" src="{{ asset('storage/'. $post->path_img )}}" alt="{{$post->title}}">
                    </div>
                    <h5>Change</h5>
                @endisset
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">    
            </div>

            {{-- 
                TAGS
                 --}}
                <div class="form-group">
                    @foreach ($tags as $tag)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" id="tag-{{$tag->id}}" value="{{$tag->id}}"
                            @if ($post->tags->contains($tag->id)) checked                                 
                            @endif>

                            <label for="tag-{{$tag->id}}">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
 
                </div>

            {{-- SUBMIT --}}
            <div class="form-group">
                <input class="btn btn-secondary" type="submit" value="Update">
            </div>
        </form>
   </div>
@endsection