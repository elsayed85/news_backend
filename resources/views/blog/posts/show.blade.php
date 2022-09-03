@extends('layouts.app')
@section('main_content')
    <div class="container">
        <div class="post-title">
            <h1>
                <a class="post_cat" href="#" target="_blank" rel="noopener noreferrer">{{ $post->category->name }}</a> :
                {{ $post->title }}
            </h1>
            <h4>
                {{ $post->author->name }}
                <img src="{{ asset($post->author->photo) }}" class="rounded-circle" alt="Avatar">
            </h4>
            <h3 class="post_published_at">
                {{ $post->published_at->diffForHumans() }}
            </h3>
        </div>
        <hr>
        <div class="post-banner">
            <img src="{{ asset($post->banner) }}">
        </div>
        <div class="post-content">
            <p>
                {!! $post->content !!}
            </p>
        </div>
        <div class="post-tags">
            @foreach ($post->tags as $tag)
                <a href="#" target="_blank" rel="noopener noreferrer">#{{ $tag->name }}</a>
            @endforeach
        </div>
        <div class="attachments">
            المرفقات
            <ul>
                @foreach ($attachments as $file)
                    <li>
                        <a href="{{ route('media.download' , $file) }}" target="_blank" rel="noopener noreferrer">
                            {{ $file->name }} - {{ $file->human_readable_size }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <br><br><br>
    </div>
@endsection

