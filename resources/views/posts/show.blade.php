
@extends('layouts.main')

@section('content')
   <div class="container mb-4">
       <h1>{{ $post->title }}</h1>
        <p> Last Update: {{$post->updated_at->diffForHumans() }}</p>
        <div class="post-status"> Post Status:
            <p class="post-status badge badge-danger">{{$post->infoPost->post_status}} </p>
        </div>  
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

        {{-- 
            TAGS 
            --}}
        
        <section class="tags">
            <h4>TAGS</h4>
            @forelse ($post->tags as $tag)
                <span class="badge badge-secondary">
                    {{$tag->name}}
                </span>
            @empty
                <p>No Active Tag for this post</p>
            @endforelse
        </section>

        @if (!empty($post->path_img))
            <img src="{{ asset('storage/'. $post->path_img)}}" alt="{{$post->title}}">
        @else
            <img src="{{asset('img/imagenofound.png')}}" alt="">
        @endif

       <p class="text mb-5 mt-5">
           {{$post->body}}
       </p>
       {{-- 
        Comments
         --}}
       <h3> Comments </h3>
       {{-- @dump($post->comments) --}}
       <ul class="comments">
           @foreach ($post->comments as $comment)
               <li class="mb-4">
                   <div class="date">{{$comment->created_at->diffForHumans()}}</div>
                   <div class="text">{{$comment->text}}</div>
                   <h5 class="author">{{$comment->author}}</h5>
               </li>
           @endforeach
       </ul>
   </div>
@endsection