@extends('layouts.app')
@section('main_content')
    @guest
        @include('partials.index.banner')
    @endguest


    @auth
        <section class="vds-main">
            @if ($show_only->contains('videos'))
                <div class="vidz-row">
                    <div class="container">
                        <div class="vidz_sec">
                            <a href="{{ route('search', ['show_only' => 'videos']) }}">
                                <h3>الفيديوهات</h3>
                            </a>
                            <hr>
                            <div class="vidz_list">
                                <div class="row">
                                    @foreach ($videos as $video)
                                        @include('partials.index.single_video_box', ['video' => $video])
                                    @endforeach
                                </div>
                            </div>
                            {{ $videos->render() }}
                            <!--vidz_list end-->
                        </div>
                        <!--vidz_videos end-->
                    </div>
                </div>
            @endif
            @if ($show_only->contains('posts'))
                <!--vidz-row end-->
                <div class="vidz-row">
                    <div class="container">
                        <div class="vidz_sec">
                            <a href="{{ route('search', ['show_only' => 'posts']) }}">
                                <h3>الاخبار</h3>
                            </a>
                            <hr>
                            <div class="vidz_list">
                                <div class="row">
                                    @foreach ($posts as $post)
                                        @include('partials.index.single_post_box', ['post' => $post])
                                    @endforeach
                                </div>
                            </div>
                            <!--vidz_list end-->
                            {{ $posts->render() }}
                        </div>
                        <!--vidz_videos end-->
                    </div>
                </div>
            @endif
        </section>
        <!--vds-main end-->
    @endauth
@endsection
