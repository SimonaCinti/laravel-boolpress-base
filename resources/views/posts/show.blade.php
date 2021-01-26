
@extends('layouts.main')

@section('content')
   <div class="container mb-4">
       <h1>{{ $post->title }}</h1>
        <p> Last Update: {{$post->updated_at->diffForHumans() }}</p>
        <div class="action mt-2 mb-5">
            {{-- Edit button --}}
            <a class="btn btn-secondary" href="{{ route('posts.edit', $post->slug) }}">Edit</a>
            {{-- Delete button --}}
            <form class="d-inline" action="{{ route('posts.destroy', $post->id )}}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>
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