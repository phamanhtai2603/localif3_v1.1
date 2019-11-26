<header class="site-navbar py-1" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-xl-2">
          <h1 class="mb-0"><a href="{{ route('get-page-view') }}" class="text-black h2 mb-0">LOGO </a></h1>
        </div>
        <div class="col-10 col-md-8 d-none d-xl-block" style="float:left">
          <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">

            <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block" style="float: left;">
              <li class="active">
                <a href="{{ route('get-page-view') }}"><strong>Home</strong></a>
              </li>
              <li><a href="page_asset/about.html">About</a></li>
              <li><a href="page_asset/contact.html">Contact</a></li>
              @if(isset(Auth::user()->email))
              <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="user-avatar rounded-circle" width="30px" height="30px" src="
                    @if(Auth::user()->avatar == null)
                        {{'upload/images/default.png'}}
                    @else
                        {{'upload/images/' . Auth::user()->avatar }}
                    @endif
                  " alt="User Avatar">
                  </a>
    
                  <div class="user-menu dropdown-menu">
                      <a class="user-options" href="{{ route('get-page-profile-view') }}"><i class="fa fa- user"></i>Profile</a>
                      @if(Auth::user()->role == 2)
                      <a class="user-options" href="{{ route('tourmanage.index') }}"><i class="fa fa- user"></i>Tours manage</a>
                      @elseif(Auth::user()->role == 3)
                      <a class="user-options" href="{{ route('customerbooked.index') }}"><i class="fa fa- user"></i>Your booked</a>
                      @endif
                      {{-- <a class="user-options" href="#"><i class="fa fa- user"></i>Thông báo: <span class="count">{{count($userNotifications)}}</span></a> --}}
    
                      <a class="user-options" href=""><i class="fa fa -cog"></i>Change password</a>
    
                      <a class="user-options" href="{{route('get-logout')}}"><i class="fa fa-power -off"></i>Logout</a>
                  </div>
              </div>
              <li><a href=""><span><i class="fa fa-lock" style="--top:14px; --left:626.487px;"></i></span><b>Xin chào <i>{{Auth::user()->first_name.' '. Auth::user()->last_name}}</i></b></a></li>
              @else
              <li><a href="{{ route('get-login') }}" class="btn btn-primary py-1 px-5 text-white">Login</a></li>
              <li><a href="{{ route('get-page-registration-view') }}" class="btn btn-primary py-1 px-5 text-white">Sign in</a></li>
              @endif

              <!-- <li><a href="booking.html">Book Online</a></li> -->
            </ul>
          </nav>
        </div>

        <div class="col-6 col-xl-2 text-right">
          <div class="d-none d-xl-inline-block">
            <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social" style="float: left;">
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