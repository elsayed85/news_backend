@extends("layouts.app")
@section("main_content")
@guest
  @include("partials.index.banner")
@endguest


@auth
<section class="vds-main">
    @if($show_only->contains('videos'))
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <a href="{{ route('search' , ['show_only' => 'videos']) }}" ><h3>الفيديوهات</h3></a>
                <hr>
                <div class="vidz_list">
                    <div class="row">
                        @foreach ($videos as $video)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                            @include('partials.index.single_video_box'  , ['video' => $video])
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
            </div>
            <!--vidz_videos end-->
        </div>
    </div>
    @endif
    @if($show_only->contains('posts'))
    <!--vidz-row end-->
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <a href="{{ route('search' , ['show_only' => 'posts']) }}"><h3>الاخبار</h3></a>
                <hr>
                <div class="vidz_list">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-lg-4 col-sm-6 col-6 full_wdth">
                            <div class="mg-inf">
                                <div class="img-sr">
                                    <a href="#" title="">
                                        <img src="{{ asset($post->banner) }}" alt="">
                                    </a>
                                </div>
                                <div class="info-sr">
                                    <h3><a href="#" title="">{{ $post->title }}</a>
                                    </h3>
                                    <span style="color:red">
                                        <i class="icon-watch_later"></i>
                                        {{ $post->published_at->diffForHumans() }}
                                    </span>
                                    <span>{{ str_limit($post->excerpt, $limit = 80, $end = '...') }}</span>
                                </div>
                            </div>
                            <!--mg-inf end-->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
            </div>
            <!--vidz_videos end-->
        </div>
    </div>
    @endif
</section>
<!--vds-main end-->
@endauth

@endsection
