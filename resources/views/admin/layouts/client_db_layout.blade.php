<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyMotivz | Recruitment Pipeline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png" />


    @include('admin.includes.style')
    @yield('style')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">



    @include('admin.includes.header')
    <div class="app-main">
        @include('admin.includes.sidebar')
        <div class="app-main__outer">
            @yield('content')

            @csrf
            @include('admin.includes.footer')
        </div>
    </div>
</div>
@include('admin.includes.scripts')
@yield('script')
</body>

</html>
