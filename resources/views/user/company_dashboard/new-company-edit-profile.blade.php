@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                    class="pe-7s-user mr-3 text-muted opacity-6"
                    style="font-size: 35px; color: #4d9a10 !important;"> </i>Update your Profile
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">

                        <div class="card-body">
{{--                            <ul>--}}
{{--                                @foreach($errors->all() as $error)--}}
{{--                                <li>{{$error}}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
                            <form id="user-company-profile" method="post"
                                  action="{{ route('user.client.profile.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <input name="company_id" type="hidden" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Company Name</label>
                                            <input type="text" name="company_name" class="form-control"
                                                   placeholder="Ccmpany Name"
                                                   value="{{$client->company_name}}">
                                        </div>
                                        @error('company_name')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Full Name</label>
                                            <input name="name" value="{{$client->name}}" type="text"
                                                   class="form-control"
                                                   placeholder="Full Name">
                                        </div>
                                        @error('name')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Title</label>
                                            <input value="{{$client->job_title}}" name="job_title" type="text"
                                                   class="form-control"
                                                   placeholder="Title">
                                        </div>
                                        @error('job_title')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input name="phone" id="phone" value="{{$client->phone}}" type="text"
                                                   class="form-control"
                                                   placeholder="Phone Number">
                                        </div>
                                        @error('phone')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input disabled name="email" value="{{$client->email}}" type="text"
                                                   class="form-control"
                                                   placeholder="">
                                        </div>
                                        @error('email')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" id="address" value="{{$client->address}}" type="text"
                                                   class="form-control"
                                                   placeholder="Address">
                                            @error('address')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--                                    <div class="col-md-4">--}}
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <label>Country</label>--}}
                                    {{--                                            <select name="country" id="country" class="form-control">--}}
                                    {{--                                                <option value="" selected disabled>Select Country</option>--}}
                                    {{--                                                @foreach($countries as $country)--}}
                                    {{--                                                    <option value="{{$country->id}}" {{ $country->id == $client->country_id ? 'selected' : '' }}>{{$country->name}}</option>--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </select>--}}
                                    {{--                                            @error('country')--}}
                                    {{--                                            <label class="error">{{$message}}</label>--}}
                                    {{--                                            @enderror--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-4">--}}
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <label>City</label>--}}
                                    {{--                                            <input name="city" id="city" value="{{$client->city}}" type="text" class="form-control" placeholder="">--}}
                                    {{--                                        </div>--}}
                                    {{--                                        @error('city')--}}
                                    {{--                                        <label class="error">{{$message}}</label>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-4">--}}
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <label>State</label>--}}
                                    {{--                                            <select class="form-control" name="state" id="state">--}}
                                    {{--                                                <option value="" selected disabled>Select State</option>--}}
                                    {{--                                                @if(!empty($states))--}}
                                    {{--                                                    @foreach($states as $state)--}}
                                    {{--                                                        <option value="{{$state->id}}" {{ $state->id == $client->state_id ? 'selected' : '' }}>{{$state->name}}</option>--}}
                                    {{--                                                    @endforeach--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </select>--}}
                                    {{--                                            @error('state')--}}
                                    {{--                                            <label class="error">{{$message}}</label>--}}
                                    {{--                                            @enderror--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>City / State or Province</label>
                                                <input name="complete_address" id="location" type="text"
                                                       class="form-control"
                                                       placeholder="Location"
                                                       value="{{$client->complete_address}}">
                                                @error('complete_address')
                                                <label class="error">{{$message}}</label>
                                                @enderror
                                            </div>
                                            {{--                                            @error('state')--}}
                                            {{--                                            <label class="error">{{$message}}</label>--}}
                                            {{--                                            @enderror--}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input name="zip_code" id="zip_code" type="text" class="form-control"
                                                   placeholder="Zip Code" value="{{$client->zip_code}}">
                                        </div>
                                        @error('zip_code')
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control"
                                                   placeholder="Website Address"
                                                   value="{{$client->web_url}}">
                                        </div>
                                        @error('web_url')
                                        {{--                                        {{$message}}--}}
                                        <label class="error">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <select class="form-control" name="industry">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option
                                                        value="{{$industry->id}}" {{ $industry->id == $client->industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('industry')
                                            <label class="error">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description (Optional)</label>
                                            <textarea class="form-control"
                                                      name="job_discription">{{$client->job_discription}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload Profile Picture <small>(The minimum dimensions of image should be 100px/100px)</small></label>
                                            <div enctype="multipart/form-data">
                                                <input id="file-upload" name="company_logo" type="file">
                                                @if(Session::has('c_email.logo') && $client->logo != '')
                                                    <br>
                                                    <a href="{{ asset('/user/company_logo/') }}/{{Session('c_email.logo')}}"
                                                       download class="resume_{{$client->id}}">
                                                        <img style="width: 100px ; height: 100px"
                                                             src="{{ asset('/user/company_logo/') }}/{{Session('c_email.logo')}}">
                                                    </a>

                                                    <a href="javascript:void(0)" onclick="resume_del({{$client->id}})"
                                                       class="icon_{{$client->id}}">
                                                        <i class="fa fa-trash" style="font-size: 17px"></i>
                                                    </a>

                                                @endif
                                            </div>
                                        </div>
                                        <label id="file-upload-error" style="display: none;" class="error"
                                               for="file-upload">Only docx and pdf files are allowed for resume.</label>
                                    </div>


                                </div>
                                <input type="submit" class="btn btn-primary pull-right" value="Update">
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>--}}
    <script>
        // $(document).ready(function () {
        //     $("#file-upload-demo,#file-upload").fileinput({
        //         'theme': 'explorer',
        //         'uploadUrl': '#',
        //         overwriteInitial: false,
        //     });
        // });

        // $("#location").on('keydown', function (event) {
        //     if (event.keyCode == 13) {
        //         event.preventDefault();
        //         return false;
        //     }
        // })

        $("#file-upload-error").on("click", function (event) {
            console.log('click')
            event.preventDefault()
            return

        })
        $(function () {
            // $('#interest').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate interests'
            // });
            // $('#skills').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate skills'
            // });
            // $('#required_certification').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate certifications'
            // });
            // $('#location').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate locations'
            // });


            // $('#job_title').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma or enter to separate job title'
            // });

        });

        $("#phone").each(function () {
            $(this).on("change keyup paste", function (e) {
                var output,
                    $this = $(this),
                    input = $this.val();

                if (e.keyCode != 8) {
                    input = input.replace(/[^0-9]/g, '');
                    var area = input.substr(0, 3);
                    var pre = input.substr(3, 3);
                    var tel = input.substr(6, 4);
                    if (area.length < 3) {
                        output = "(" + area;
                    } else if (area.length == 3 && pre.length < 3) {
                        output = "(" + area + ")" + " " + pre;
                    } else if (area.length == 3 && pre.length == 3) {
                        output = "(" + area + ")" + " " + pre + "-" + tel;
                    }
                    $this.val(output);
                }
            });
        });

        {{--$("#country").change(function () {--}}

        {{--    var id = $(this).val();--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('ajax.get.states') }}",--}}
        {{--        type: "POST",--}}
        {{--        async: false,--}}
        {{--        data: {--}}
        {{--            _token: '{{csrf_token()}}',--}}
        {{--            id: id--}}
        {{--        },--}}
        {{--        success: function (response) {--}}

        {{--            $('#state option').each(function () {--}}
        {{--                if ($(this).val() != '') {--}}
        {{--                    $(this).remove();--}}
        {{--                }--}}
        {{--            });--}}

        {{--            var states = response['states'];--}}
        {{--            for (i = 0; i < states.length; i++) {--}}
        {{--                $('#state')--}}
        {{--                    .append($("<option></option>")--}}
        {{--                        .attr("value", states[i]['id'])--}}
        {{--                        .text(states[i]['name']));--}}
        {{--            }--}}
        {{--        },--}}
        {{--    });--}}

        {{--});--}}

        $(document).ready(function () {
            // alert('doc ready')
            $("#file-upload-demo,#file-upload").fileinput({
                'theme': 'explorer',
                'uploadUrl': '#',
                overwriteInitial: false,
            });
            // function initialize() {
            //     var input = document.getElementById('location');
            //     var options = {
            //         types: ['(regions)'] //this should work !
            //     };
            //
            //     var autocomplete = new google.maps.places.Autocomplete(input, options);
            //     // autocomplete.setComponentRestrictions(
            //     //     {'country': ['us']});
            // }
            //
            // google.maps.event.addDomListener(window, 'load', initialize);


            $("#user-company-profile").validate({
                rules: {
                    // email:{
                    //     required: true,
                    //     email: true
                    // } ,
                    company_name: {
                        required: true,
                        // alphanumericspace: true,
                        minlength: 1,
                        maxlength: 255
                    },
                    name: {
                        required: true,
                        alpha_space: true,
                        minlength: 1,
                        maxlength: 255
                    },
                    job_title: {
                        required: true,
                        alpha_space: true,
                        minlength: 1,
                        maxlength: 255
                    },
                    phone: {
                        required: true,
                        phonenumber: true,
                        minlength: 14,
                        maxlength: 14,
                    },
                    address: {
                        locationvalidation: true,
                        required: true,
                        maxlength: 255
                        // addressvalidation: true,
                        // minlength: 2,
                    },
                    // country: {
                    //     required: true,
                    // },
                    // } ,
                    complete_address: {
                        required: true,
                        locationvalidation: true,
                        maxlength: 255
                        // minlength: 2,
                    },
                    // city:{
                    //     required: true,
                    //     cityvalidation: true,
                    //     minlength: 2,
                    //     maxlength:255
                    // } ,
                    // state:{
                    zip_code: {
                        required: true,
                        digits: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    web_url: {
                        required: true,
                        validUrl: true
                    },
                    industry: {
                        required: true,
                    },
                    job_discription: {
                        // required: true,
                        // maxlength: 500,
                    },
                    //     required: true,
                    company_logo: {
                        extension: 'png|jpg|jpeg',
                    },

                    // complete_address:{
                    //     required: true,
                    // }

                },
                messages: {

                    company_name: {
                        required: "Company Name is required.",
                        minlength: "Company Name is required",
                        maxlength: "Company Name must be less than 255 characters long.",
                        // alpha_space: "Letters only."
                    },

                    name: {
                        required: "Full name is required.",
                        minlength: "Name is required",
                        maxlength: "Name must be less than 255 characters long.",
                        // alpha_space: "Letters only."
                    },

                    // complete_address:{
                    //     required: "Location is required.",
                    // },

                    job_title: {
                        // required: "Job title is required.",
                        minlength: "Job title is required",
                        maxlength: "Job title must be less than 255 characters long.",
                        // alpha_space: "Letters only."
                    },

                    // email:{
                    //     required: "Email is required.",
                    //     email: "Please Enter Valid Email."
                    // } ,

                    phone: {
                        required: "Phone number is required.",
                        phonenumber: "Please enter a valid Phone number.",
                        minlength: "Phone number must be equal to 14 characters.",
                        maxlength: "Phone number must be equal to 14 characters.",
                    },

                    address:{
                        required: "Address is required.",
                        locationvalidation: "Address must be in valid format.",
                        // addressvalidation: "Address must be in valid format.",
                        // minlength: "Address must be at least 2 characters long.",
                        maxlength: "Address must be less than 255 characters long."
                    } ,
                    // country:{
                    //     required: "Country is required.",
                    // } ,
                    // city:{
                    //     required: "City is required.",
                    //     cityvalidation: "City must be in valid format.",
                    //     minlength: "City must be at least 2 characters long.",
                    //     maxlength:"City must be less than 255 characters long."
                    // } ,
                    // state:{
                    //     required: "State is required.",
                    // } ,
                    complete_address: {
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        maxlength: "Job location must be less than 255 characters long."
                        // minlength: "Job location must be at least 2 characters long.",
                    },
                    zip_code: {
                        required: "Zip Code is required.",
                        digits: "Zip code must be in valid format.",
                        minlength: "Zip Code must be at least 2 characters long.",
                        maxlength: "Zip Code must be less than 255 characters long."
                    },
                    web_url: {
                        required: "Web Address is required.",
                        url: "Web Address url is invalid."
                    },

                    industry: {
                        required: "Industry is required.",
                    },

                    job_discription: {
                        // required: "Description is required.",
                        // maxlength: "Description must be less than 500 characters long.",
                    },
                    company_logo: {
                        extension: "Only png, jpg and jpeg files are allowed for profile picture.",
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });


            $('#logo-company').change(function () {

                $('#company-logo-form').submit();
            });

            // jQuery.validator.addMethod("alpha_space", function(value, element) {
            //     /*return this.optional(element) || /^[+?0-9\-\(\)\s]+$/i.test(value);*/
            //     return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
            // });

            // jQuery.validator.addMethod("phonenumber", function(value, element) {
            //     /*return this.optional(element) || /^[+?0-9\-\(\)\s]+$/i.test(value);*/
            //     return this.optional(element) || /^[0-9\-\(\)\s]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("addressvalidation", function(value, element) {
            //     return this.optional(element) || /^[a-zA-Z0-9,. ]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("cityvalidation", function(value, element) {
            //     return this.optional(element) || /^[a-zA-Z,. ]+$/i.test(value);
            // });


        });

        function resume_del(id) {
            sweetAlert({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/company/delete-logo",
                            type: "POST",
                            async: false,
                            data: {id: id, "_token": "{{ csrf_token() }}"},
                            success: function (response) {
                                if (response == 'deleted') {
                                    $(".resume_" + id).hide();
                                    $(".icon_" + id).hide();
                                    $("#company_logo1").attr('src', "{{ asset('/user/images/featured-img1.jpg') }}")
                                    $.notify("Profile Picture Deleted Successfully", {
                                        clickToHide: true,
                                        autoHide: true,
                                        autoHideDelay: 2000,
                                        arrowShow: true,
                                        arrowSize: 5,
                                        breakNewLines: true,
                                        elementPosition: "bottom",
                                        globalPosition: "top center",
                                        style: "bootstrap",
                                        className: "success",
                                        show: "slideDown",
                                        showDuration: 200,
                                        hideAnimation: "slideUp",
                                        hideDuration: 200,
                                        gap: 5,
                                    });
                                    // location.reload();

                                }
                            },
                        });
                    }

                });

        }


    </script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
@endsection
