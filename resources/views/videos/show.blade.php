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
			@livewire("videos.video-player" , ['video' => $video])
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
										123 مشاهدة
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
@section("after_js")
<script>
        window.addEventListener('active_video_changed', event => {
            console.log(event);
            const player = videojs('my-video', {});
        });
 </script>
@endsection
