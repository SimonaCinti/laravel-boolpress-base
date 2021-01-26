
@extends('layouts.main')

@section('content')
    @if (session('post-deleted'))
        <div class="alert alert-success">
            <h3>Post '{{ session('post-deleted') }}' deleted</h3>
        </div>
    @endif
   <div class="container mb-4">
       <h1>Blog Archive</h1>
       @forelse ($posts as $post)
           <article class="mb-5">
                
                <h2>{{ $post->title }}</h2>
                <h5> {{ $post->created_at->format('d/m/Y') }}</h5>

                <p>{{$post->body}}</p>
                <a href="{{ route('posts.show', $post->slug) }}"> Read More</a>
           </article>
       @empty
           <h3> No post found! <a href="{{ route('posts.create')}}">Create a new one</a></h3>
       @endforelse
   </div>
@endsection