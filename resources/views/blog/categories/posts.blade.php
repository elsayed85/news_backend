@extends('layouts.app')
@section('title', 'Categories')
@section('main_content')
    <section class="browse_categories_sec">
        <div class="container">
            <div class="browse_categories">
                <div class="row">
                    @forelse($posts as $post)
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
                    @empty
                        No Posts here
                    @endforelse
                    {{-- <div class="col-lg-2 col-md-4 col-sm-4 col-6 full_wdth">
                        <div class="br-channel">
                            <div class="br-channel-img">
                                <a href="#" title="">
                                    <img src="images/resources/br1.jpg" alt="">
                                </a>
                            </div>
                            <div class="br-info">
                                <h3><a href="#" title="">BattleState</a></h3>
                                <span>230 Videos</span>
                            </div>
                        </div>
                        <!--br-channel end-->
                    </div> --}}

                    {{ $posts->links() }}
                </div>
            </div>
            <!--</div> end-->
        </div>
    </section>
@endsection
