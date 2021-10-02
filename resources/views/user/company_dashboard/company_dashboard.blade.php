@extends('layouts.user_layout')

@section('title' , 'Company Dashboard')

@section('content')
    <!--// Main Banner \\-->
    <div class="mm-subheader"><h1>Company Dashboard</h1></div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    @include('user.include.client_side_bar')

                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@stop

@section('script')

@endsection

