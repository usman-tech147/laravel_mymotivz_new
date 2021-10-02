<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyMotivz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{asset('new-panel/user-panel/assets/images/favicon.png')}}" type="image/png" />
    <link href="{{asset('new-panel/user-panel/assets/main.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/user-panel/assets//font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/user-panel/style.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/user-panel/assets/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('new-panel/user-panel/assets/file-input/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('new-panel/user-panel/assets/file-input/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{{asset('new-panel\user-panel/assets\scripts\main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_API")}}&libraries=places" ></script>
    <script async type="text/javascript" src="{{asset('google-map.js')}}"></script>


    @yield('css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header">
            <div class="app-header__logo">
                <a href="{{route('welcome')}}" class="logo-src"></a>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
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
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            @include('user.include.menue_bar')
        </div>
        <div class="app-main">
            @include('user.include.new_cadidate_side_bar')
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 18px;" id="connect_popup"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script type="text/javascript" src="{{ asset('user/script/jquery.js') }}"></script> -->

    <script src="{{asset('new-panel\user-panel\assets\scripts\file-input\sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('new-panel\user-panel\assets\scripts\file-input\fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('new-panel\user-panel\assets\scripts\file-input\theme.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('new-panel\user-panel\assets\scripts\jquery.tagsinput.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets\scripts\jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets\scripts\additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('new-panel\user-panel\assets\scripts\functions.js')}}"></script>
<!-- <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaifbsayz8l_Lfs1ZdE3MywHPzy046cIA&libraries=places" ></script> -->

    <script  src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('partials.additional_validator')

    @yield('js')
<script>
    $( document ).ready(function() {
        var invalid= 0;
        $.each($("input,select,textarea","#form_profile"),function () {

            if(!$(this).val())
            {
                invalid++;
            }

        });
        if(invalid > 3){
            $("#connect_popup").html('The profile must be completed prior to connecting with a career developer.');
        }
        else
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('prof_completed') }}",
                type:"POST",
                async : false,
                data:{"_token": "{{ csrf_token() }}"},
                success:function(response){
                    $("#connect_popup").html('Thank You for submitting your profile. One of our Career Developers will be reaching out to you shortly');

                },
            });

        }


        $("#change_pass_form").validate({
            rules: {
                old_pass:{
                    required:true,
                },
                new_pass:{
                    required: true,
                    minlength:6,
                    maxlength : 20,
                    checkSpecialchar:true,
                    checkupper: true,
                    checkdigit: true,
                },
                new_pass_confirm: {
                    required: true,
                    equalTo: "#new_pass",
                },
            },
            messages: {
                old_pass:{
                    required:"Old Password is required.",
                },
                new_pass: {
                    required: "Please Enter Password.",
                    minlength: "Password must be minimum 6 characters long.",
                    maxlength: "Password must be less than 20 characters.",
                    checkSpecialchar : "Password must contain at least 1 special character.",
                    checkupper: 'Password must contain at least one upper case character.',
                    checkdigit: 'Password must contain at least one digit.',

                },
                new_pass_confirm: {
                    required: "Please Enter Confirm Password.",
                    equalTo: "Password did not match.",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        var value = $("#new_pass").val();
        $.validator.addMethod("checkSpecialchar", function(value) {
            return /[^\w\s]/gi.test(value);
        });
        $.validator.addMethod("checkupper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
    });
    function candidateAccDel() {
        var text = document.createElement('div')
        text.innerHTML="Once your account is deleted, all of your saved information will be permanently deleted as well. This means you’ll lose access to your profile and account information.<br><ul class='list-style-two'><li><span>Saved resumes</span></li><li><span>Professional Summary</span></li><li><span>Apply history</span></li><li><span>Saved jobs</span></li></ul>"
        sweetAlert({
            title: "Are you sure you want to delete your account?",
            content: text,
            icon: "warning",
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {

                    window.location.href = "{{ route('delete.candidate.account')}}";
                }

            });

    }


</script>
</body>

</html>
