<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('get-admin-view') }}"><i class="menu-icon fa fa-tachometer"></i>Bảng điều khiển </a>
                </li>
                <li class="menu-title">Chức năng</li><!-- /.menu-title -->
                <li>
                <a href="{{ route('user.index') }}"> <i class="menu-icon ti-user"></i>Quản lý người dùng</a>
                </li>
                <li >
                    <a href="{{ route('location.index') }}" > <i class="menu-icon ti-wallet"></i>Quản lý địa điểm</a>
                </li>
                <li >
                    <a href="{{ route('tour.index') }}" > <i class="menu-icon ti-receipt"></i>Quản lý bài đăng</a>
                </li>
                <li >
                    <a href="{{ route('bookedtour.index') }}" > <i class="menu-icon ti-view-list-alt"></i>Quản lý tour đã book</a>
                </li>
                <li >
                    <a href="{{ route('revenue.index') }}" > <i class="menu-icon ti-wallet"></i>Thống kê</a>
                </li>
           
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>