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
                  @auth
                      <div class="search_form">
                          <form action="{{ route('search') }}">
                              <input type="text" placeholder="اكتب هنا واضغط Enter" name="query_text">
                              <button type="submit">
                                  <i class="icon-search"></i>
                              </button>
                          </form>
                      </div>
                      <!--search_form end-->
                  @endauth
                  <ul class="controls-lv">
                      @auth
                          <li class="user-log">
                              <div class="user-ac-img">
                                  {{ auth()->user()->name }}
                              </div>
                              <div class="account-menu">
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
                              </div>
                          </li>
                          <li>
                              <a href="{{ route('notifications.list_all') }}" title="">
                                  <i class="icon-notification"></i>
                                  <span class="notification-badge">
                                    {{ getUnreadNotificationsCount() }}
                                  </span>
                              </a>
                          </li>
                      @endauth

                      @guest
                          <li>
                              <a href="{{ route('filament.auth.login') }}">تسجيل الدخول</a>
                          </li>
                      @endguest

                      @auth
                          @role('writer')
                              <li>
                                  <a href="{{ route('filament.resources.videos/videos.create') }}" class="btn-default">ارفع
                                      فيديو</a>
                              </li>
                          @endrole
                      @endauth
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
