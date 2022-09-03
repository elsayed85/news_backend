@extends("layouts.app")
@section("main_content")
@guest
  @include("partials.index.banner")
@endguest

@auth
<section class="vds-main">
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <a href="{{ route('recent_videos') }}" ><h3>فيديوهات جديده</h3></a>
                <hr>
                <div class="vidz_list">
                    <div class="row">
                        @foreach ($recent_videos as $video)
                            @include('partials.index.single_video_box'  , ['video' => $video])
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
            </div>
            <!--vidz_videos end-->
        </div>
    </div>
    <!--vidz-row end-->
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <a href="{{ route('top_watched_videos') }}"><h3>الاكثر مشاهدة</h3></a>
                <hr>
                <div class="vidz_list">
                    <div class="row">
                        @foreach ($top_watched_videos as $video)
                            @include('partials.index.single_video_box'  , ['video' => $video])
                        @endforeach
                    </div>
                </div>
                <!--vidz_list end-->
            </div>
            <!--vidz_videos end-->
        </div>
    </div>
</section>
<!--vds-main end-->
@endauth

@endsection
