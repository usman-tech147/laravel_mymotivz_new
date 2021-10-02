@extends('layouts.user_layout')

@section('title' , 'Company Profile')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Company Profile</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    @include('user.include.client_side_bar')
                    <div class="col-md-9">
                        <div class="mm-motivz-jobdetail-content">
                            @if( session()->has('success') )
                                <div style="text-align: center" class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <h2 class="form-title">Company Profile</h2>
                            <form id="user-company-profile" method="post" action="{{ route('user.client.profile.submit') }}">

                                @csrf

                                <input name="company_id" type="hidden" value="{{ session('c_email.id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Company Name</label>
                                            <input name="company_name" type="text" class="form-control" placeholder="" value="{{$client->company_name}}">
                                            @error('company_name')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Full Name</label>
                                            <input name="name" type="text" class="form-control" placeholder="" value="{{$client->name}}">
                                            @error('name')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Your Title</label>
                                            <input value="{{$client->job_title}}" name="job_title" type="text" class="form-control" placeholder="">
                                            @error('job_title')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input name="phone" id="phone" type="text" class="form-control" placeholder="" value="{{$client->phone}}">
                                            @error('phone')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input disabled name="email" type="email" class="form-control" placeholder="" value="{{$client->email}}">
                                            @error('email')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" id="address" type="text" class="form-control" placeholder="" value="{{$client->address}}">
                                            @error('address')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="" selected disabled>Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{ $country->id == $client->country_id ? 'selected' : '' }}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="city" id="city" type="text" class="form-control" placeholder="" value="{{$client->city}}">
                                            @error('city')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select name="state" id="state" class="form-control">
                                                <option value="" selected disabled>Select State</option>
                                                @if(!empty($states))
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{ $state->id == $client->state_id ? 'selected' : '' }}>{{$state->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('state')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input name="zip_code" id="zip_code" type="text" class="form-control" placeholder="" value="{{$client->zip_code}}">
                                            @error('zip_code')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website Address <small>(http://www.example.com)</small></label>
                                            <input name="web_url" type="text" class="form-control" placeholder="" value="{{$client->web_url}}">
                                            @error('web_url')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Industry</label>
{{--                                            <input name="industry" type="text" class="form-control" placeholder="" value="{{$client->industry}}">--}}
                                            <select name="industry" id="" class="form-control">
                                                <option value="" selected disabled>Select Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}" {{ $industry->id == $client->industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('industry')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="job_discription" class="form-control">{{$client->job_discription}}</textarea>
                                            @error('job_discription')
                                            <label class="text-danger">{{$message}}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="form-submit">Update Company Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('user/script/company/companyProfile.js') }}"></script>
    <script type="text/javascript">
        $("#phone").each(function(){
            $(this).on("change keyup paste", function (e) {
                var output,
                    $this = $(this),
                    input = $this.val();

                if(e.keyCode != 8) {
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

        $("#country").change(function(){

            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.get.states') }}",
                type:"POST",
                async : false,
                data:{ _token: '{{csrf_token()}}',
                        id   : id},
                success:function(response){

                    $('#state option').each(function() {
                        if ( $(this).val() != '' ) {
                            $(this).remove();
                        }
                    });

                    var states = response['states'];
                    for(i=0;i<states.length;i++)
                    {
                         $('#state')
                            .append($("<option></option>")
                            .attr("value", states[i]['id'])
                            .text(states[i]['name']));
                    }
                },
            });

        });

        /*function initialize() {
            var input = document.getElementById('location');
            var options = {
                types: ['(regions)'] //this should work !
            };

            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.setComponentRestrictions(
                {'country': ['us']});
        }
        google.maps.event.addDomListener(window, 'load', initialize);*/
    </script>
@endsection

