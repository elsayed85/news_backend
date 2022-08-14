  <header>
      <div class="top_bar">
          <div class="container">
              <div class="top_header_content">
                  <div class="menu_logo">
                      <a href="#" title="" class="menu">
                          <i class="icon-menu"></i>
                      </a>
                      <a href="{{ route('home') }}" title="" class="logo">
                          <img src="{{ asset('main/images/logo.png') }}" alt="">
                      </a>
                  </div>
                  <!--menu_logo end-->
                  @livewire('site.videos-search-bar')

                  <!--search_form end-->
                  <ul class="controls-lv">
                      @auth
                          <li class="user-log">
                              <div class="user-ac-img">
                                  {{ auth()->user()->name }}
                              </div>
                              <div class="account-menu">
                                  <div class="sd_menu">
                                      <ul class="mm_menu">
                                          <li>
                                              <span>
                                                  <i class="icon-settings"></i>
                                              </span>
                                              <a href="{{ route('filament.pages.profile') }}">الاعدادات</a>
                                          </li>
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
                              </div>
                          </li>
                      @endauth

                      @guest
                          <li>
                              <a href="{{ route('filament.auth.login') }}">تسجيل الدخول</a>
                          </li>
                      @endguest

                      <li>
                          <a href="{{ route('filament.resources.videos/videos.create') }}" class="btn-default">ارفع
                              فيديو</a>
                      </li>
                  </ul>
                  <!--controls-lv end-->
                  <div class="clearfix"></div>
              </div>
              <!--top_header_content end-->
          </div>
      </div>
      <!--header_content end-->
  </header>
  <!--header end-->
