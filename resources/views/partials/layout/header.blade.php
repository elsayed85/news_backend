  <header>
      <div class="top_bar">
          <div class="container">
              <div class="top_header_content">
                  <div class="menu_logo">
                      <a href="#" title="" class="menu">
                          <i class="icon-menu"></i>
                      </a>
                      <a href="index.html" title="" class="logo">
                          <img src="{{ asset('main/images/logo.png') }}" alt="">
                      </a>
                  </div>
                  <!--menu_logo end-->
                  <div class="search_form">
                      <form>
                          <input type="text" name="search" placeholder="اكتب هنا واضغط Enter">
                          <button type="submit">
                              <i class="icon-search"></i>
                          </button>
                      </form>
                  </div>
                  <!--search_form end-->
                  <ul class="controls-lv">
                      <li>
                          <a href="#" title=""><i class="icon-message"></i></a>
                      </li>
                      <li>
                          <a href="#" title=""><i class="icon-notification"></i></a>
                      </li>
                      <li class="user-log">
                          <div class="user-ac-img">
                              <img src="{{ asset('main/images/resources/user-img.png') }}" alt="">
                          </div>
                          <div class="account-menu">
                              @auth
                                  <h4>
                                      {{ auth()->user()->name }}
                                      <span class="usr-status">العقيد</span>
                                  </h4>
                                  <div class="sd_menu">
                                      <ul class="mm_menu">
                                          <li>
                                              <span>
                                                  <i class="icon-user"></i>
                                              </span>
                                              <a href="#" title="">قناتي</a>
                                          </li>
                                          <li>
                                              <span>
                                                  <i class="icon-settings"></i>
                                              </span>
                                              <a href="#" title="">الاعدادات</a>
                                          </li>
                                          <li>
                                              <span>
                                                  <i class="icon-logout"></i>
                                              </span>
                                              <a href="#" title="">تسجيل الخروج</a>
                                          </li>
                                      </ul>
                                  </div>
                              @endauth

                              @guest

                              @endguest
                          </div>
                      </li>
                      <li>
                          <a href="Upload_Video.html" title="" class="btn-default">ارفع فيديو</a>
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
