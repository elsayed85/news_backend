<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title ? "{$page_title} - " : null }} {{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('main/images/Favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    @yield('before_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/fontello-codes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/thumbs-embedded.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main/css/color.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/main/css/rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/main/css/news.css') }}">
    @livewireStyles
    @yield('after_css')

    <script>
        var site_url = "{{ url('/') }}"
    </script>
</head>


<body>
    <div class="wrapper hp_1" id="app">
        @include('partials.layout.header')

        <div class="side_menu">
            <div class="form_dvv">
                <a href="{{ route('filament.auth.login') }}" title="" class="login_form_show">تسجيل الدخول</a>
            </div>
            <div class="sd_menu">
                <ul class="mm_menu">
                    <li>
                        <span>
                            <i class="icon-home"></i>
                        </span>
                        <a href="{{ route('home') }}" title="">الصفحة الرئيسيه</a>
                    </li>
                    <li>
                        <span>
                            <i class="icon-fire"></i>
                        </span>
                        <a href="{{ route('top_watched_videos') }}" title="">الاكثر مشاهدة</a>
                    </li>
                </ul>
            </div>
            <!--sd_menu end-->
            <div class="sd_menu">
                <h3>المكتبه</h3>
                <ul class="mm_menu">
                    <li>
                        <span>
                            <i class="icon-history"></i>
                        </span>
                        <a href="#" title="">تاريخ البحث</a>
                    </li>
                    <li>
                        <span>
                            <i class="icon-watch_later"></i>
                        </span>
                        <a href="#" title="">المشاهدة لاحقا</a>
                    </li>
                    <li>
                        <span>
                            <i class="icon-like"></i>
                        </span>
                        <a href="#" title="">الاعجابات</a>
                    </li>
                </ul>
            </div>
            @auth
                <div class="sd_menu">
                    <ul class="mm_menu">
                        @hasanyrole('super_admin|writer')
                            <li>
                                <span>
                                    <i class="icon-settings"></i>
                                </span>
                                <a href="{{ route('filament.pages.profile') }}" title="">الاعدادات</a>
                            </li>
                        @endrole
                        <li>
                            <span>
                                <i class="icon-logout"></i>
                            </span>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('filament_logout').submit();">تسجيل
                                الخروج</a>
                        </li>
                    </ul>
                </div>
                <div class="sd_menu m_linkz">
                    <span>{{ auth()->user()->name }}</span>
                </div>
            @endauth
            <div class="dd_menu"></div>
        </div>
        <!--side_menu end-->

        @yield('main_content')

        {{-- @include('partials.index.footer_logo') --}}

        @auth
        <section class="demo-section-box">
            <div class="section-container">
                <div class="demo-box">
                    <div class="breaking-news-ticker" id="newsTicker15">
                        <div class="bn-label">أخبار</div>
                        <div class="bn-news">
                            <ul id="news_datalist">

                            </ul>
                        </div>
                        <div class="bn-controls">
                            <button><span class="bn-arrow bn-prev"></span></button>
                            <button><span class="bn-action"></span></button>
                            <button><span class="bn-arrow bn-next"></span></button>
                        </div>
                    </div>
                    <!-- *********************** -->
                    <!-- DEMO15 HTML END HERE *** -->

                </div>
            </div>
        </section>
        @endauth
    </div>
    <!--wrapper end-->

    <form method="post" action="{{ route('filament.auth.logout') }}" id="filament_logout">
        {{ csrf_field() }}
    </form>

    @yield('before_js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('main/js/jquery.min.js') }}"></script>
    <script src="{{ asset('main/js/popper.js') }}"></script>
    <script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('main/js/flatpickr.js') }}"></script>
    <script src="{{ asset('main/js/script.js') }}"></script>
    <script src="{{ asset('main/js/breaking-news-ticker.min.js') }}"></script>
    <script type="text/javascript">
        function init_breakingNews() {
            $('#newsTicker15').breakingNews({
                position: 'fixed-bottom',
                borderWidth: 3,
                height: 50,
                themeColor: '#ce2525',
                direction: 'rtl',
                source: {
                    type: 'json',
                    url: '{{ route('breakingnews.get_posts') }}',
                    limit: 20,
                    showingField: 'title',
                    linkEnabled: true,
                    target: '_blank',
                    seperator: '<span class="bn-seperator" style="background-image:url({{ asset('images/logo.gif') }});"></span>',
                    errorMsg: 'Json file not loaded. Please check the settings.'
                }
            });
        }
        init_breakingNews();
        Echo.channel('blog_posts')
            .listen('.new_post_published', (e) => {
                console.log(e);
                init_breakingNews();
            });
    </script>
    @livewireScripts
    {{-- @livewire('notifications') --}}
    @auth
        <script src="{{ asset('main/js/online_users.js') }}"></script>
    @endauth
    @yield('after_js')
    <x-impersonate::banner style='light' />
</body>

</html>
