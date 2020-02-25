<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="/mag/img/67794854_2178648335729029_448519625085288448_n.png">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="/mag/style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        @include('templates.navbar')
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcrumb Area Start ##### -->
    <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(@yield('coverBackground'));">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="mag-breadcrumb py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @yield('breadcrumb')
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Post Details Area Start ##### -->
    <section class="post-details-area">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Post Details Content Area -->
                <div class="col-12 col-xl-8">
                    <div class="post-details-content bg-white mb-30 p-30 box-shadow">
                        <div class="blog-thumb mb-30">
                            @yield('cover')
                        </div>
                        <div class="blog-content">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!-- Sidebar Widget -->
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="sidebar-area bg-white mb-30 box-shadow">
                        <!-- Sidebar Widget -->
                        <div class="single-sidebar-widget p-30">
                            @yield('others')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Post Details Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('templates.footer')
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    @include('templates.srcs.js-src')
</body>
</html>