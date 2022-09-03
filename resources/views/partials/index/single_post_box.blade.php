<div class="col-lg-3 col-md-6 col-sm-6 col-6 full_wdth">
    <div class="mg-inf">
        <div class="img-sr">
            <a href="{{ route('blog.post.show' , $post) }}" title="">
                <img src="{{ asset($post->banner) }}" alt="">
            </a>
        </div>
        <div class="info-sr">
            <h3><a href="{{ route('blog.post.show' , $post) }}" title="">{{ $post->title }}</a>
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
