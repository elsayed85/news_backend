@extends("layouts.app")
@section("main_content")
@guest
  @include("partials.index.banner")
@endguest

<section class="vds-main">
    <div class="vidz-row">
        <div class="container">
            <div class="vidz_sec">
                <a href="{{ route('recent_videos') }}" ><h3>فيديوهات جديده</h3></a>
                <hr>
                <div class="vidz_list">
                    <div class="row">
                        @foreach ($videos as $video)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
                            @include('partials.index.single_video_box'  , ['video' => $video])
                        </div>
                        @endforeach
                    </div>
                    {{ $videos->links() }}
                </div>
                <!--vidz_list end-->
            </div>
            <!--vidz_videos end-->
        </div>
    </div>
</section>
<!--vds-main end-->

@endsection
