<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyMotivz</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{asset('new-panel/company-panel/assets/images/favicon.png')}}" type="image/png"/>
    <link href="{{asset('new-panel/company-panel/assets/main.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/company-panel/assets/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/company-panel/style.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/company-panel/assets/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/company-panel/assets/file-input/fileinput.css')}}" media="all" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('new-panel/company-panel/assets/file-input/theme.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    {{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">--}}
    @yield('css')

    {{--    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>--}}
    <script type="text/javascript" src="{{ asset('user/script/jquery.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API')}}&libraries=places"></script>
    <script async src="{{asset('google-map.js')}}"></script>
    {{--    <script type="text/javascript" src="{{asset('new-panel/company-panel/assets/scripts/main.js')}}"></script>--}}


</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    <div class="app-header">
        <div class="app-header__logo">
            <a href="{{route('welcome')}}" class="logo-src"></a>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        @include('user.include.company-menue')
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                    <span>
                        <button type="button"
                                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
            </div>
            @include('user.include.company_side_bar')
        </div>
        <div class="app-main__outer">
            @yield('content')
            <div class="app-wrapper-footer">
                <div class="app-footer">
                    <div class="app-footer__inner">
                        <p class="mb-0">© 2021 - All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
<script type="text/javascript"
        src="{{asset('new-panel/company-panel/assets/scripts/file-input/sortable.js')}}"></script>
<script type="text/javascript"
        src="{{asset('new-panel/company-panel/assets/scripts/file-input/fileinput.js')}}"></script>
<script type="text/javascript" src="{{asset('new-panel/company-panel/assets/scripts/file-input/theme.js')}}"></script>
<script type="text/javascript"
        src="{{asset('new-panel/company-panel/assets/scripts/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets\scripts\jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets\scripts\additional-methods.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{--    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>--}}

<script src="{{asset('ckeditor.js')}}"></script>

{{--    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>--}}
<!-- include summernote css/js -->
{{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>--}}
<script type="text/javascript" src="{{asset('new-panel/company-panel/assets/scripts/functions.js')}}"></script>
<script src="{{asset('easy-number-separator.js')}}"></script>
@include('partials.additional_validator')

<script>
    function companyAccDel() {
        var text = document.createElement('div')
        text.innerHTML = "This will delete everything including: <br><ul class='list-style-two'> <li><span>Company profile</span></li> <li><span>All associated jobs</span></li> <li><span>Applicants and resumes</span></li><li><span>Team members</span></li></ul> <br> If you just need to cancel your subscription, please navigate to the <a href='javascript:void(0)' style='color:#4d9a10; font-weight:bold;'>Subscriptions & Payments page</a>. Once your account is deleted, you will not be able to receive or view any applicants from your job listing."
        sweetAlert({
            title: "Are you sure?",
            content: text,
            icon: "warning",
            confirmButtonText: 'Confirm',
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
        }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = "{{ route('delete.company.account')}}";
                }

            });

    }
</script>
@yield('js')
</body>

</html>
