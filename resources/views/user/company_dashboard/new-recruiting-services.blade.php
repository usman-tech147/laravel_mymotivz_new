@extends('layouts.company')

@section('content')
    <div class="app-main__inner">
        @if( session()->has('success') )
            <div style="text-align: center" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-settings mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Recruiting Services</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">

                        <div class="card-body">
                            <form id="user-create-job-form" action="{{ route('user.client.recruitment.created') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="company_name" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input name="jobtitle" type="text" class="form-control" placeholder="Title" value="{{old('jobtitle')}}">
                                        </div>
                                        @error('jobtitle')
                                        <label id="jobtitle-error" class="error" for="jobtitle">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Education</label>
                                            <select name="education" class="form-control">
                                                <option value="" selected disabled>Select Education</option>
                                                @foreach($Education as $education)
                                                    <option value="{{$education->id}}">{{$education->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('education')
                                        <label id="education-error" class="error" for="education">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Location</label>
                                            <input name="location" id="location" type="text" class="form-control" placeholder="Job Location" value="{{old('location')}}">
                                            @error('location')
                                            <label id="location-error" class="error" for="location">{{$message}}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="Website Address" value="{{old('web_url')}}">
                                            @error('web_url')
                                            <label id="web_url-error" class="error" for="web_url">{{$message}}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Industry</label>
                                            <select name="industry" class="form-control">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('industry')
                                            <label id="industry-error" class="error" for="industry">{{$message}}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type of service needed</label>
                                            <select name="service" class="form-control">
                                                <option value="" selected disabled>Select Service Type</option>
                                                <option value="Direct" @if(old('service')=='Direct') selected @endif>Direct Placement</option>
                                                <option value="Temporary" @if(old('service')=='Temporary') selected @endif>Temporary Staffing</option>
                                            </select>
                                            @error('service')
                                            <label id="service-error" class="error" for="service">{{$message}}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Enter your desired pay</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">$</span>
                                                        </div>
                                                        <input name="package" id="package" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="From" value="" >
                                                        @error('package')
                                                        <label id="package-error" class="error" for="package">{{$message}}</label>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <span id="add_range" style="  display: block;   text-align: center;margin: 12px 0px 0px;font-size: 17px;font-weight: 600;cursor: pointer;">+ Add Range</span>
                                                    <div class="input-group mb-3 div_package_to" id="div_package_to" style="display: none">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text currecny_sign" id="inputGroup-sizing-default">$</span>
                                                            <input type="hidden" id="hidd_curr_sign" name="hidd_curr_sign" value="$">
                                                        </div>
                                                        <input name="package_to" id="package_to" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="To" value="" >
                                                        @error('package_to')
                                                        <label id="package_to-error" class="error" for="package_to">{{$message}}</label>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to" >
                                                        <select style="font-size: 12px;" name="curr_sign" id="curr_sign" class="form-control">
                                                            <option value="USD"  >USD</option>
                                                            <option value="CAD" >CAD</option>
                                                            <option value="GBP" >GBP</option>
                                                            <option value="EUR" >EUR</option>
                                                            <option value="AUD" >AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3 div_package_to">
                                                        <select style="font-size: 12px;" name="salary_duration" id="salary_duration" class="form-control">
                                                            <option value="hourly" >hourly</option>
                                                            <option value="daily" >daily</option>
                                                            <option value="weekly" >weekly</option>
                                                            <option value="monthly" >monthly</option>
                                                            <option value="annually" >annually</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Attach File (Optional)</label>
                                            <div enctype="multipart/form-data">
                                                <input id="file-upload" name="document" type="file">
                                            </div>
                                        </div>
                                        <label id="file-upload-demo-error" style="display: none;" class="error" for="file-upload">Only docx and pdf files are allowed for document.</label>
                                        @error('document')
                                        <label id="document" class="error" for="document">{{$message}}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Job Descriptions</label>
                                            <textarea name="job_discription" class="form-control" placeholder="">{{old('job_discription')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
    <script>
        var editor = null;
        ClassicEditor.create(document.querySelector("#job_discription"), {
            toolbar: [
                "heading",
                "fontFamily",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "imageUpload",
                "blockQuote",
                "undo",
                "redo",
                "imageStyle:full",
                "imageStyle:side",
                "|",
                "imageTextAlternative",
                "contenteditable",
                // "tableColumn",
            ],
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#file-upload-demo,#file-upload").fileinput({
                'theme': 'explorer',
                // 'uploadUrl': '#',
                overwriteInitial: false,
            });
        });
        $("#file-upload-demo-error").on("click" , function (event){
            console.log('click')
            event.preventDefault()
            return

        })
        $(function () {
            $('#interest').tagsInput({
                width: 'auto',
                defaultText: 'Use comma to separate interests'
            });
            $('#skills').tagsInput({
                width: 'auto',
                defaultText: 'Use comma to separate skills'
            });
            $('#required_certification').tagsInput({
                width: 'auto',
                defaultText: 'Use comma to separate certifications'
            });
            // $('#location').tagsInput({
            //     width: 'auto',
            //     defaultText: 'Use comma to separate locations'
            // });
            $('#benefits').tagsInput({
                width: 'auto',
                defaultText: 'Use comma to separate job benefits'
            });
        });

        // function initialize() {
        //     var input = document.getElementById('location');
        //     var options = {
        //         types: ['(regions)'] //this should work !
        //     };
        //
        //     var autocomplete = new google.maps.places.Autocomplete(input, options);
        // }
        //
        // google.maps.event.addDomListener(window, 'load', initialize);

        $( document ).ready(function() {

            $("#user-create-job-form").validate({
                ignore: [],
                rules: {
                    jobtitle: {
                        required: true,
                        alphanumericspace: true,
                        minlength: 2,
                        maxlength:255
                    } ,
                    education:{
                        required: true,
                    } ,
                    /*city:{
                        required: true,
                        alpha_space: true,
                        minlength: 2,
                        maxlength:255
                    } ,
                    state:{
                        required: true,
                        alpha_space: true,
                        minlength: 2,
                        maxlength:255
                    } ,*/
                    location:{
                        required: true,
                        locationvalidation: true,
                        // minlength: 2,
                        maxlength:255
                    } ,
                    web_url: {
                        required: true,
                        validUrl: true
                    },
                    package:{
                        required: true,
                        currencyvalidation: true,
                        minlength: 1,
                        maxlength: 20
                        // positivedigit:true,
                    } ,
                    package_to:{
                        currencyvalidation: true,
                        // greaterThan:true,
                        greaterThanPackage: '#package',
                        maxlength: 20
                        // positivedigit:true,
                    } ,
                    salary_duration:{
                        required: true,
                    },
                    industry:{
                        required: true,
                    } ,
                    service:{
                        required: true,
                    },
                    job_discription:{
                        required: true,
                        // maxlength:500
                    } ,
                    document:{
                        extension : 'doc|docx|pdf',
                    }

                },
                messages: {

                    jobtitle: {
                        required: "Job title is required.",
                        minlength: "Job title  must be at least 2 characters long.",
                        maxlength: "Job title  must be less than 255 characters long.",
                        // alpha_space:"Letters only."
                    } ,
                    education:{
                        required: "Education is required.",
                    } ,
                    location:{
                        required: "Job location is required.",
                        locationvalidation: "Job location must be in valid format.",
                        // minlength: "Job Location must be at least 2 characters long.",
                        maxlength: "Job location must be less than 255 characters long."
                    } ,
                    /*city:{
                        required: "City is required.",
                        minlength: "City must be at least 2 characters long.",
                        maxlength: "City must be less than 255 characters long."
                    } ,
                    state:{
                        required: "State is required.",
                        minlength: "State must be at least 2 characters long.",
                        maxlength: "State must be less than 255 characters long."
                    } ,*/
                    web_url: {
                        required: "Website url is required.",
                        url: "Please enter valid url."
                    },
                    package:{
                        required: "Salary is required.",
                        currencyvalidation: "Salary should be in valid format.",
                        minlength: "Salary must be at least 1 characters long.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    } ,
                    package_to:{
                        currencyvalidation: "Salary should be in valid format.",
                        // greaterThan: "Maximum salary range must be greater than minimum salary.",
                        greaterThanPackage: "Maximum salary range must be greater than minimum salary.",
                        maxlength: "Salary must be less than 20 characters long."
                        // positivedigit:"Salary must be positive.",
                    } ,
                    salary_duration:{
                        required: "Salary duration is required",
                    },
                    industry:{
                        required: "Type of industry is required.",
                    } ,
                    service:{
                        required: "Please select service from dropdown."
                    },
                    job_discription:{
                        required: "Job description is required.",
                        // maxlength: "Job description must be less than 255 characters long."
                    } ,
                    document: {
                        extension: "Only pdf, doc and docx files are allowed.",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            // jQuery.validator.addMethod("greaterThanPackage",
            //     function (value, element, params) {
            //
            //         if (value === "" || (parseFloat(value) > parseFloat($(params).val()))) {
            //             return true;
            //         }
            //         return false;
            //     });
            // jQuery.validator.addMethod("alpha_space", function(value, element) {
            //     return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("currencyvalidation", function(value, element) {
            //     return this.optional(element) || /^[,.?0-9]+$/i.test(value);
            // });
            // jQuery.validator.addMethod("locationvalidation", function(value, element) {
            //     return this.optional(element) || /^[a-zA-Z, ]+$/i.test(value);
            // });

            // jQuery.validator.addMethod("greaterThan", function (value, element) {
            //     var salary_to = value;
            //     var salary_from = $("#package").val();
            //
            //     if (value.indexOf(',') > -1){
            //         salary_to = value.replace(',','');
            //     }
            //     if(salary_from.indexOf(',') > -1)
            //     {
            //         salary_from = salary_from.replace(',','');
            //     }
            //     salary_from = parseInt(salary_from);
            //     salary_to = parseInt(salary_to);
            //     if(salary_from >= salary_to)
            //     {
            //         return false;
            //     }
            //     else
            //     {
            //         return true;
            //     }
            // });

        });

        $("#add_range").on('click' , function (){
            $("#div_package_to").show()
            $(this).hide()
        })

        $("#curr_sign").change(function(){
            if($(this).val() == "USD")
            {
                $(".currecny_sign").text('$');
                $("#hidd_curr_sign").val('$');
            }
            else if($(this).val() == "CAD")
            {
                $(".currecny_sign").text('C$');
                $("#hidd_curr_sign").val('C$');
            }
            else if($(this).val() == "GBP")
            {
                $(".currecny_sign").text('£');
                $("#hidd_curr_sign").val('£');
            }
            else if($(this).val() == "AUD")
            {
                $(".currecny_sign").text('A$');
                $("#hidd_curr_sign").val('A$');
            }
            else
            {
                $(".currecny_sign").text('€');
                $("#hidd_curr_sign").val('€');
            }
        });
        $("#add_range").click(function () {
            $("#add_range").hide();
            $(".div_package_to").show();
        });

    </script>

@endsection
