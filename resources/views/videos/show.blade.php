@extends("layouts.app")
@section("after_css")
	<link rel="stylesheet" type="text/css" href="{{ asset('main/css/video-js.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/jquery.mCustomScrollbar.min.css') }}">
@endsection
@section("after_js")
<script src="{{ asset('main/js/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ asset('main/js/video.js') }}"></script>
@endsection

@section("main_content")
@guest
  @include("partials.index.banner")
@endguest


	<section class="mn-sec full_wdth_single_video">
		<div class="container">
			<div class="row gap_remove">


				<div class="col-lg-9">
					<div class="vid-pr">
						<video
						    id="my-video"
						    class="video-js"
						    controls
						    preload="auto"
						    width="640"
						    height="264"
						    poster="{{ asset('main//main/images/resources/poster-img.jpg') }}"
						    data-setup="{}"
						  >
						    <source src="{{ asset('main/demo_video.mp4') }}" type="video/mp4" />
						    <source src="{{ asset('main/demo_video.webm') }}" type="video/webm" />
						</video>
					</div><!--vid-pr end-->
				</div>
				<div class="col-lg-3">
					<div class="playlist_view">
						<div class="playlist_hd">
							<h3>الفيديوهات<span>2 / 76</span></h3>
							<ul>
								<li>
									<a href="#" title="">
										<i class="icon-add_to_playlist"></i>
									</a>
								</li>
								<li>
									<a href="#" title="">
										<i class="icon-like"></i>
									</a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div><!--playlist_hd end-->
						<div class="clearfix"></div>
						<ul class="videos_lizt mCustomScrollbar" data-mcs-theme="dark">
							<li>
								<div class="vidz_row">
									<span class="vid_num">1</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th6.jpg" alt="">
										</a>
										<span class="vid-time">13:49</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">DR DISRESPECT - Before They Were..</a></h3>
										<h4><a href="#" title="">Eros Now</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">2</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th7.jpg" alt="">
										</a>
										<span class="vid-time">2:54</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Top Perectly Timed Twitch Moments..</a></h3>
										<h4><a href="#" title="">Animal Planet</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">3</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th8.jpg" alt="">
										</a>
										<span class="vid-time">5:25</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Amazing Bridge Block ever in PUBG</a></h3>
										<h4><a href="#" title="">Maketzi</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">4</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th9.jpg" alt="">
										</a>
										<span class="vid-time">4:01</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Trailer Park Boys Season 12 Trailer</a></h3>
										<h4><a href="#" title="">ScereBro</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">5</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th10.jpg" alt="">
										</a>
										<span class="vid-time">8:16</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">A day in the life of a Google software.. </a></h3>
										<h4><a href="#" title="">MathChief </a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">6</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th6.jpg" alt="">
										</a>
										<span class="vid-time">13:49</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">DR DISRESPECT - Before They Were..</a></h3>
										<h4><a href="#" title="">Eros Now</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">7</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th7.jpg" alt="">
										</a>
										<span class="vid-time">2:54</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Top Perectly Timed Twitch Moments..</a></h3>
										<h4><a href="#" title="">Animal Planet</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">8</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th8.jpg" alt="">
										</a>
										<span class="vid-time">5:25</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Amazing Bridge Block ever in PUBG</a></h3>
										<h4><a href="#" title="">Maketzi</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">9</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th9.jpg" alt="">
										</a>
										<span class="vid-time">4:01</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">Trailer Park Boys Season 12 Trailer</a></h3>
										<h4><a href="#" title="">ScereBro</a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
							<li>
								<div class="vidz_row">
									<span class="vid_num">10</span>
									<div class="vidz_img">
										<a href="#" title="">
											<img src="/main/images/resources/th10.jpg" alt="">
										</a>
										<span class="vid-time">8:16</span>
										<span class="watch_later">
											<i class="icon-watch_later_fill"></i>
										</span>
									</div><!--vidz_img end-->
									<div class="video_info">
										<h3><a href="#" title="">A day in the life of a Google software.. </a></h3>
										<h4><a href="#" title="">MathChief </a></h4>
									</div>
								</div><!--vidz_row end-->
							</li>
						</ul><!--videos_lizt end-->
					</div><!--playlist_view end-->
				</div>


                
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="mn-vid-sc single_video">
						<div class="vid-1">
							<div class="vid-info">
									<h3>
                                    {{ $video->title }}
									</h3>
									<div class="info-pr">
										<span>
										{{ views($video)->count() }} مشاهدة
										</span>
										<div class="clearfix"></div>
									</div>
									<!--info-pr end-->
								</div>
						</div><!--vid-1 end-->
						<div class="abt-mk">
								<div class="info-pr-sec">
									<div class="vcp_inf cr">
										<div class="vc_hd">
											<img src="images/resources/th5.png" alt="">
										</div>
										<div class="vc_info pr">
											<h4><a href="#" title="">
                                            {{ $video->author->name }}
                                            </a></h4>
											<span>
                                            تم النشر
                                             {{ $video->published_at->diffForHumans() }}
                                            </span>
										</div>
									</div>
									<!--chan_cantrz end-->
									<ul class="df-list">
										<li>
											<button data-toggle="tooltip" data-placement="top" title="مشاهدة لاحقا">
												<i class="icon-watch_later"></i>
											</button>
										</li>
										<li>
											<button data-toggle="tooltip" data-placement="top"
												title="التبليغ عن الفيديو">
												<i class="icon-flag"></i>
											</button>
										</li>
									</ul>
									<!--df-list end-->
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
								<div class="about-ch-sec">
									{!! $video->content !!}
									<br><hr>
                                    @if($video->tags->count() > 0)
									<div class="abt-rw tgs">
										<h4>من قسم : </h4>
										<ul>
                                        @foreach ($video->tags as $tag)
											<li><a href="#" title="">#{{ $tag->name }}</a></li>
                                        @endforeach
										</ul>
									</div>
                                    @endif
								</div>
								<!--about-ch-sec end-->
							</div>
					</div><!--mn-vid-sc end--->
				</div><!---col-lg-9 end-->
				<div class="col-lg-3">
						<div class="sidebar">
							<div class="vidz-prt">
								<h2 class="sm-vidz">
									فيديوهات مشابهة
								</h2>
								<div class="clearfix"></div>
							</div>
							<!--vidz-prt end-->
							<div class="videoo-list-ab">
								<div class="videoo">
									<div class="vid_thumbainl">
										<a href="single_video_page.html" title="">
											<img src="images/resources/vide1.png" alt="">
											<span class="vid-time">10:21</span>
											<span class="watch_later">
												<i class="icon-watch_later_fill"></i>
											</span>
										</a>
									</div>
									<!--vid_thumbnail end-->
									<div class="video_info">
										<h3><a href="#" title="">
												خبر عاجل جدا جدا جدا
											</a>
										</h3>
										<h4><a href="#" title="">
												مركز المعلومات
											</a> <span class="verify_ic"><i class="icon-tick"></i></span></h4>
										<span>686K مشاهدة .<small class="posted_dt">منذ 5 دقائق</small></span>
									</div>
								</div>
								<!--videoo end-->
								<div class="videoo">
									<div class="vid_thumbainl">
										<a href="single_video_page.html" title="">
											<img src="images/resources/vide1.png" alt="">
											<span class="vid-time">10:21</span>
											<span class="watch_later">
												<i class="icon-watch_later_fill"></i>
											</span>
										</a>
									</div>
									<!--vid_thumbnail end-->
									<div class="video_info">
										<h3><a href="#" title="">
												خبر عاجل جدا جدا جدا
											</a>
										</h3>
										<h4><a href="#" title="">
												مركز المعلومات
											</a> <span class="verify_ic"><i class="icon-tick"></i></span></h4>
										<span>686K مشاهدة .<small class="posted_dt">منذ 5 دقائق</small></span>
									</div>
								</div>
								<!--videoo end-->
								<div class="videoo">
									<div class="vid_thumbainl">
										<a href="single_video_page.html" title="">
											<img src="images/resources/vide1.png" alt="">
											<span class="vid-time">10:21</span>
											<span class="watch_later">
												<i class="icon-watch_later_fill"></i>
											</span>
										</a>
									</div>
									<!--vid_thumbnail end-->
									<div class="video_info">
										<h3><a href="#" title="">
												خبر عاجل جدا جدا جدا
											</a>
										</h3>
										<h4><a href="#" title="">
												مركز المعلومات
											</a> <span class="verify_ic"><i class="icon-tick"></i></span></h4>
										<span>686K مشاهدة .<small class="posted_dt">منذ 5 دقائق</small></span>
									</div>
								</div>
								<!--videoo end-->

								<div class="videoo">
									<div class="vid_thumbainl">
										<a href="single_video_page.html" title="">
											<img src="images/resources/vide1.png" alt="">
											<span class="vid-time">10:21</span>
											<span class="watch_later">
												<i class="icon-watch_later_fill"></i>
											</span>
										</a>
									</div>
									<!--vid_thumbnail end-->
									<div class="video_info">
										<h3><a href="#" title="">
												خبر عاجل جدا جدا جدا
											</a>
										</h3>
										<h4><a href="#" title="">
												مركز المعلومات
											</a> <span class="verify_ic"><i class="icon-tick"></i></span></h4>
										<span>686K مشاهدة .<small class="posted_dt">منذ 5 دقائق</small></span>
									</div>
								</div>
								<!--videoo end-->

							</div>
							<!--videoo-list-ab end-->
						</div>
						<!--side-bar end-->
					</div>
			</div>
		</div>
	</section><!--mn-sec end-->

@endsection
