
@extends('layouts.main')

@section('content')
   <div class="container mb-4">
       <h1>{{ $post->title }}</h1>
        <p> Last Update: {{$post->updated_at->diffForHumans() }}</p>
        <div class="action mb-5">
            <a class="btn btn-secondary" href="{{ route('posts.edit', $post->slug) }}">Edit</a>
        </div>

        @if (!empty($post->path_img))
            <img src="{{ asset('storage/'. $post->path_img)}}" alt="{{$post->title}}">
        @else
            <img src="{{asset('img/imagenofound.png')}}" alt="">
        @endif

       <p class="text mb-5 mt-5">
           {{$post->body}}
       </p>

   </div>
@endsection