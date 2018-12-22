<!DOCTYPE html >
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http - equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Laravel Khoa Pham </title>
    @yield("title")
    <base href="{{asset("")}}">
    <!--Bootstrap Core CSS-->
    <link href="client_asset/css/bootstrap.min.css" rel="stylesheet">

    <!--Custom CSS-->
    @yield("css")
    <link href="client_asset/css/shop-homepage.css" rel="stylesheet">
    <link href="client_asset/css/my.css" rel="stylesheet">

    <!--HTML5 Shim and Respond . js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond . js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
@include("client.layouts.header")

<!-- Page Content -->
<div class="container">
    <!-- slider -->
@include("client.layouts.slide")
<!-- end slide -->
    <div class="space20"></div>
    <div class="row main-left">
        @include("client.layouts.menu")
        <div class="col-md-9">
            @yield("content")
        </div>
    </div>
</div>
<!-- end Page Content -->

<!-- Footer -->
<hr>
@include("client.layouts.footer")
<!-- end Footer -->
<!-- jQuery -->
<script src="client_asset/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="client_asset/js/bootstrap.min.js"></script>
<script src="client_asset/js/my.js"></script>
@yield("script")
</body>

</html>
