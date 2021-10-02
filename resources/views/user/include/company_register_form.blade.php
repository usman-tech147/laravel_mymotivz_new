@if(Session::has('verify'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title:"Thank You!",
            icon: "success",
            text:"Your enquiry has been submitted successfully"
        });
    </script>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('verify')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<ul>
    @foreach($errors->all() as $error)
        <li class="error">
            {{$error}}
        </li>
    @endforeach

</ul>
<form action="{{route('find.talent')}}" method="POST" name="form_talent" id="form_talent" enctype="multipart/form-data">
    @csrf
    <ul>
        <li class="widget-50"><input type="text" name="name" placeholder="Your name" value="{{old('name')}}">
            @error('name')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li class="widget-50"><input type="text" name="title" placeholder="Your title" value="{{old('title')}}">
            @error('title')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li class="widget-50"><input type="text" name="company" placeholder="Your company" value="{{old('company')}}">
            @error('company')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        @php
            $industries=\App\Industry::all();
        @endphp
        <li class="widget-50"><select name="industry" class="form-control">
                <option value="" selected disabled>Select Industry</option>
                @foreach($industries as $industry)
                    <option value="{{$industry->id}}" @if($industry->id==old('industry')) selected @endif>{{$industry->name}}</option>
                @endforeach
            </select>
            @error('industry')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li><input type="text" name="email" placeholder="Your email"  value="{{old('email')}}">
            @error('email')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        {{--<li class="widget-30"><input type="text" name="phone_ext" placeholder="+1" maxlength="3" value="{{old('phone_ext')}}">
            @error('phone-ext')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>--}}
        <li {{--class="widget-70"--}}><input type="text" name="phone_no" id="phone_no" placeholder="Your phone" value="{{old('phone_no')}}">
            @error('phone_no')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li><input type="text" name="position" placeholder="Position you would like to fill" value="{{old('position')}}">
            @error('position')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li><textarea placeholder="Enter job description" name="job_desc">{{old('job_desc')}}</textarea>
            @error('job_desc')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li>
            <select name="sel_service" id="sel_service">
                <option value="">Select Service</option>
                <option value="Short-term">Short-term Contract</option>
                <option value="Long-term">Long-Term Contract</option>
                <option value="Contract">Contract-to-hire</option>
                <option value="Direct">Direct Placement</option>
            </select>
            @error('sel_service')
            <label for="" class="error">{{$message}}</label>
            @enderror
        </li>
        <li>
            <div class="g-recaptcha" name="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
            @error('g-recaptcha-response')
            <label for="" class="error">{{$message}}</label>
            @enderror


        </li>
        <li><input type="submit" value="Find Talent Now"></li>
    </ul>
</form>


