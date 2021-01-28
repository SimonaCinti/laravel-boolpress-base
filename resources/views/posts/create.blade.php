
@extends('layouts.main')

@section('content')
   <div class="container mb-4">
       <h1>Create New Post</h1>
        {{-- 
            Errors
            --}}
       @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>     
       @endif
        {{-- 
            MAIN FORM
             --}}
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title')}}">    
            </div>

            <div class="form-group">
                <label for="body">Description</label>
                <textarea class="form-control" name="body" id="body">{{ old('body')}}</textarea>   
            </div>

            <div class="form-group">
                <label for="path_img">Post Image</label>
                <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">    
            </div>

            {{-- 
                TAGS
                --}}
                <div class="form-group">
                    @foreach ($tags as $tag)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" id="tag-{{$tag->id}}" value="{{$tag->id}}">
                            <label for="tag-{{$tag->id}}">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
 
                </div>
            {{-- SUBMIT  --}}
            <div class="form-group">
                <input class="btn btn-secondary" type="submit" value="Create new post">
            </div>
        </form>
   </div>
@endsection