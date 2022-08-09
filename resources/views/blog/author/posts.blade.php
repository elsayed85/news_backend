@extends('layouts.app')
@section('title', "$author->name Posts")
@section('main_content')
    <section class="channel-cover">
        <img src="{{ asset('main/images/resources/channel-banner.jpg') }}" alt="">
    </section>
    <!--channel-cover end-->

    <section class="videso_section">
        <div class="info-pr-sec">
            <div class="container">
                <div class="vcp_inf cr">
                    <div class="vc_info pr">
                        <h4>{{ $author->name }} <span class="verify_ic"><i class="icon-tick"></i></span></h4>
                    </div>
                    <span class="vc_hd">
                        <img src="{{ asset($author->photo) }}" alt="">
                    </span>
                </div>
                <!--chan_cantrz end-->
                <div class="search_form" style="float:left">
                    <form action="{{ route('blog.author.search_posts' , $author) }}">
                    @csrf
                        <input type="text" name="search" placeholder="البحث عن المقالات" name="q">
                        <button type="submit">
                            <i class="icon-search"></i>
                        </button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--info-pr-sec end-->
        <div class="history-lst tbY">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.author.posts', $author) }}" role="tab"
                            aria-selected="false">المقالات </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.author.profile', $author) }}" role="tab"
                            aria-selected="false">عن الكاتب</a>
                    </li>
                </ul>
                <!--nav-tabs end-->
                <div class="clearfix"></div>
            </div>
        </div>
        <!--history-lst end-->
        <div class="tab-content p-0" id="myTabContent">
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="container">
                    <div class="amz_products_content">
                        @forelse ($posts_categories as $category)
                            <div class="amazon">
                                <div class="abt-amz">
                                    <div class="amz-hd">
                                        <h2>
                                            <span>{{ $category->name }} </span>
                                        </h2>
                                    </div>
                                    <!--amz-hd end-->
                                    <div class="amz-lg">
                                        <a
                                            href="{{ route('blog.author.posts_in_category', ['author' => $author, 'category' => $category]) }}">عرض
                                            الكل</a>
                                    </div>
                                    <!--amz-lg end-->
                                    <div class="clearfix"></div>
                                </div>
                                <!--abt-amz end-->
                                <div class="amz-img-inf">
                                    <div class="row">
                                        @foreach ($category->posts as $post)
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
                                <!--amz-img-in-->
                            </div>
                            <!--amazon end-->
                        @empty

                        @endforelse
                    </div>
                    <!--amz_products_content end-->

                </div>
            </div>
        </div>
    </section>
    <!--Featured Videos end-->
@endsection
