@extends('layouts.user_layout')
@section('title' , 'Home Page')
@section('content')

    <!--// Main Banner \\-->

    <div class="motivz-banner" style="background-image: url('{{ asset('user/images/banner-img.png') }}');">
        <div class="motivz-table">
            <div class="motivz-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="motivz-banner-text">
                                <h3>  Employer welcome page </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            alert('admin page')
        })


    </script>
@endsection
