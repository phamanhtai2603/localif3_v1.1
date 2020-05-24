<header id="header" class="header">
  <div class="top-left">
      <div class="navbar-header">
          <a class="navbar-brand" href="{{ route('get-admin-view') }}"><img src="admin_page_asset/images/logo.png" alt="Logo"></a>
          <a class="navbar-brand hidden" href="{{ route('get-admin-view') }}"><img src="admin_page_asset/images/logo2.png" alt="Logo"></a>
          <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
      </div>
  </div>
  <div class="top-right">
      <div class="header-menu">
          <div class="header-left">
              <button class="search-trigger"><i class="fa fa-search"></i></button>
              <div class="form-inline">
                  <form class="search-form">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                      <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                  </form>
              </div>
            {{-- @if (count($notifications) >= 0) 1--}}

              <div class="dropdown for-notification ">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-bell"></i>
                        <span class="count bg-danger" id="count">
                            {{-- {{ count($notifications) }} 1--}}
                        </span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="notification" id="thongBao">
                      <p class="red">Bạn có 
                          {{-- {{ count($notifications) }} 1--}}
                           thông báo</p>
                      {{-- @foreach ($notifications as $noti)
                      <a class="dropdown-item media" href="
                        @if ($noti->notifiable_type == 'App\Message')
                            {{ route('get-contact-view') }}
                        @elseif($noti->notifiable_type == 'App\User')
                            {{ route('get-user-view') }}
                        @elseif($noti->notifiable_type == 'App\Booking')
                            {{ route('get-booking-noti',['id' => $noti->notifiable_id]) }} 
                             
                        @endif
                      ">
                          <i class="fa fa-check"></i>
                          <p>{{ json_decode($noti->data)->subject }}</p>
                      </a>
                      
                      @endforeach 1--}}

                  </div>
              </div>
            {{-- @endif 1--}}
              <div class="dropdown for-message">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-envelope"></i>
                      <span class="count bg-primary">4</span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="message">
                      <p class="red">You have 4 Mails</p>
                      <a class="dropdown-item media" href="#">
                          <span class="photo media-left"><img alt="avatar" src="admin_page_asset/images/avatar/1.jpg"></span>
                          <div class="message media-body">
                              <span class="name float-left">Jonathan Smith</span>
                              <span class="time float-right">Just now</span>
                              <p>Hello, this is an example msg</p>
                          </div>
                      </a>
                      <a class="dropdown-item media" href="#">
                          <span class="photo media-left"><img alt="avatar" src="admin_page_asset/images/avatar/2.jpg"></span>
                          <div class="message media-body">
                              <span class="name float-left">Jack Sanders</span>
                              <span class="time float-right">5 minutes ago</span>
                              <p>Lorem ipsum dolor sit amet, consectetur</p>
                          </div>
                      </a>
                      <a class="dropdown-item media" href="#">
                          <span class="photo media-left"><img alt="avatar" src="admin_page_asset/images/avatar/3.jpg"></span>
                          <div class="message media-body">
                              <span class="name float-left">Cheryl Wheeler</span>
                              <span class="time float-right">10 minutes ago</span>
                              <p>Hello, this is an example msg</p>
                          </div>
                      </a>
                      <a class="dropdown-item media" href="#">
                          <span class="photo media-left"><img alt="avatar" src="admin_page_asset/images/avatar/4.jpg"></span>
                          <div class="message media-body">
                              <span class="name float-left">Rachel Santos</span>
                              <span class="time float-right">15 minutes ago</span>
                              <p>Lorem ipsum dolor sit amet, consectetur</p>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="dropdown float-right">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="user-avatar rounded-circle" width="40px" height="40px" src="
                @if(Auth::user()->avatar == null)
                    {{'upload/images/default.png'}}
                @else
                    {{'upload/images/' . Auth::user()->avatar }}
                @endif
              " alt="User Avatar">
              </a>

              <div class="user-menu dropdown-menu textsizeMini">
                    <a class="nav-link" href="{{route('get-admin-profile-view')}}"><i class="fa fa- user"></i>Quản lý tài khoản</a>
                   <a class="nav-link" href="#"><i class="fa fa- user"></i>Thông báo<span class="count">13</span></a>
                    <a class="nav-link" href="{{route('get-admin-logout')}}"><i class="fa fa-power -off"></i>Đăng xuất</a>
              </div>
          </div>
          </div>

         

      </div>
  </div>
</header>