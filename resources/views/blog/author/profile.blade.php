@extends('layouts.app')
@section('title', "$author->name Profile")
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
                    <form>
                        <input type="text" name="search" placeholder="البحث عن المقالات">
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
                        <a class="nav-link" href="{{ route('blog.author.posts', $author) }}" role="tab"
                            aria-selected="false">المقالات </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.author.profile', $author) }}" role="tab"
                            aria-selected="false">عن الكاتب</a>
                    </li>
                </ul>
                <!--nav-tabs end-->
                <div class="clearfix"></div>
            </div>
        </div>
        <!--history-lst end-->
        <div class="tab-content p-0" id="myTabContent">
            <div class="tab-pane fade show active" id="about_tab" role="tabpanel" aria-labelledby="about-tab">
                <div class="about_tab_content">
                    <div class="container">
                        <div class="description">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="decp_cotnet">
                                        <h2 class="ab-fd">عن الكاتب </h2>
                                        <p>{!! $author->bio !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <!--stats end-->
                                    <div class="flagg">
                                        <ul>
                                            <li>
                                                <a href="#" title="">
                                                    <i class="icon-flag"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--flagg end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--about_tab_content end-->
            </div>
        </div>
    </section>
    <!--Featured Videos end-->
@endsection
