@extends('page_layout.page_masterpage')

@section('title')
Xác thực tài khoản
@endsection

@section('content')

    <!--============= PAGE-COVER =============-->
    <section class="page-cover" id="cover-login">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title">Xác thực tài khoản</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active">Xác thực tài khoản</li>
                    </ul>
                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end page-cover -->

       
    <!--===== INNERPAGE-WRAPPER ====-->
    <section class="innerpage-wrapper">
        <div id="login" class="innerpage-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="flex-content">
                            <div class="custom-form custom-form-fields">
                                <h3>Xác thực tài khoản</h3>
                                @if (session('msg'))
                                    <div class="alert alert-danger">
                                        {{session('msg')}}
                                    </div>
                                @endif
                                <p>Bạn cần xác thực tài khoản email để kính hoạt tài khoản.</p>
                                <p>Hãy đăng nhập vào tài khoản email để kính hoạt tài khoản.</p>
                            </div><!-- end custom-form -->
                            
                            <div class="flex-content-img custom-form-img">
                                <img src="page_asset/images/good-vacation-wishes5.jpg" class="img-responsive" alt="registration-img" />
                            </div><!-- end custom-form-img -->
                        </div><!-- end form-content -->
                        
                    </div><!-- end columns -->
                </div><!-- end row -->
            </div><!-- end container -->         
        </div><!-- end login -->
    </section><!-- end innerpage-wrapper -->

    <!--======================= BEST FEATURES =====================-->
    @include('page.components.best_features')


    <!--========================= NEWSLETTER-1 ==========================-->
    @include('page.components.newsletter_1')

@endsection
