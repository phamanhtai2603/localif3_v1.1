<header class="site-navbar py-1" role="banner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6 col-xl-2">
        <a href="{{ route('get-page-view') }}" class="text-black h2 mb-0">
          <img class="user-avatar rounded-circle" width="80px" src="upload/images/logo.jpg" alt="User Avatar">
        </a>
      </div>
      <div class="col-10 col-md-8 d-none d-xl-block">
        <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">
          <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
            <li class="active">
              <a href="{{ route('get-page-view') }}">Home</a>
            </li>
            <li><a href="page_asset/about.html">About</a></li>
            <li><a href="page_asset/contact.html">Contact</a></li>
            @if(isset(Auth::user()->email))
            <li class="has-children active">
              <a href="{{ route('get-page-profile-view') }}">
                <i>{{Auth::user()->first_name.' '. Auth::user()->last_name}}</i>
                <img class="user-avatar rounded-circle"  width="30px" src="
                    @if(Auth::user()->avatar == null)
                        {{ 'upload/images/default.png' }}
                    @else
                        {{'upload/images/' . Auth::user()->avatar }}
                    @endif
                  " alt="User Avatar">
              </a>
              <ul class="dropdown" style="text-align:center">
                <li><a href="{{ route('get-page-profile-view') }}">Profile</a></li>
                @if(Auth::user()->role == 2)
                <li><a href="{{ route('tourmanage.index') }}">Tours post manage</a></li>
                <li><a href="{{ route('tourguidebooked.index') }}">Bookings manage</a></li>
                <li><a href="{{ route('tourguidebusy.index') }}">Busy days</a></li>
                @elseif(Auth::user()->role == 3)
                <li><a href="{{ route('customerbooked.index') }}">Your booked</a></li>
                @endif
                <li>{{-- <a href="#">Thông báo: <span class="count">{{count($userNotifications)}}</span></a> --}}</li>
                <li><a href="{{route('page-revenue')}}">Revenue</a></li>
                <li><a href="{{route('get-logout')}}">Logout</a></li>
              </ul>
            </li>          
            @else
            <li><a href="{{ route('get-login') }}" class="btn btn-primary py-1 px-3 text-white">Login</a></li>
            <li><a href="{{ route('get-page-registration-view') }}" class="btn btn-primary py-1 px-3 text-white">Sign in</a></li>
            @endif
          </ul>
          {{-- <div class="dropdown for-notification ">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                  <span class="count bg-danger" id="count">{{ count($notifications) }}</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="notification" id="thongBao">
                <p class="red">Bạn có n thông báo</p>
                @foreach ($notifications as $noti)
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
                
                @endforeach

            </div>
        </div> --}}
        </nav>
      </div>
      <div class="col-6 col-xl-2 text-right">
        <div class="d-none d-xl-inline-block">
          <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
            <li>
              <a href="#" class="pl-3 pr-3 text-black"><span class="icon-twitter"></span></a>
            </li>
            <li>
              <a href="#" class="pl-3 pr-3 text-black"><span class="icon-facebook"></span></a>
            </li>
            <li>
              <a href="#" class="pl-3 pr-3 text-black"><span class="icon-instagram"></span></a>
            </li>
          </ul>
        </div>
        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#"
            class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>
      </div>
    </div>
  </div>
</header>
