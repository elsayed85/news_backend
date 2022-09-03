<div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
    <div class="videoo">
        <div class="vid_thumbainl">
            <a href="{{ route('videos.show', $video) }}" title="{{ $video->title }}">
                <img src="{{ $video->getThumb() }}" alt="{{ $video->title }}">
                {{-- <span class="vid-time">10:21</span> --}}
                <span class="watch_later">
                    <i class="icon-watch_later_fill"></i>
                </span>
            </a>
        </div>
        <!--vid_thumbnail end-->
        <div class="video_info">
            <h3><a href="{{ route('videos.show', $video) }}" title="">{{ $video->title }}</a></h3>
            <h4><a href="{{ route('videos.show', $video) }}" title="">{{ $video->author->name }}</a> <span
                    class="verify_ic"><i class="icon-tick"></i></span></h4>
            <span><small class="posted_dt">{{ $video->published_at->diffForHumans() }}</small></span>
        </div>
    </div>
</div>
