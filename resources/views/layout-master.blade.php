<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>SDSSU WBREMS @yield('title')</title>
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

    <!-- ##### Mag Posts Area Start ##### -->
    @yield('content')
    <!-- ##### Mag Posts Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('templates.footer')
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    @include('templates.srcs.js-src')
</body>
</html>