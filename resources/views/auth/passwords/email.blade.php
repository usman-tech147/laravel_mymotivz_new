


@extends('layouts.admin-login-layout')

@section('content')
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-6">
                        <!-- <div class="app-logo-inverse mx-auto mb-3"></div> -->

                        <div class="modal-dialog w-100">

                            <div class="modal-content">

                              <!--   <div class="modal-header">


                                    
                                </div> -->
                                <div class="modal-body">
                                       <div class="custom-logo">
                                        <img src="{{asset('storage/logo/favicon.png')}}" alt="">
                                    </div>
                                    <div class="h5 modal-title text-center" style="width: 100%;">Forgot your Password?<h6 class="mt-1 mb-0 opacity-8"><span>Use the form below to recover it.</span></h6></div>
                                    <div>
                                        <form class="" method="POST" action="{{ route('password.email') }}">
                                             @csrf
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group"><label for="exampleEmail" class="">Email</label> <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="divider"></div>
                                    <h6 class="mb-0"><a href="{{ route('login') }}" class="text-primary">Sign in existing account</a></h6></div>
                                <div class="modal-footer clearfix">
                                    <div class="float-right">
                                        <button class="btn btn-primary btn-lg">Recover Password</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">© 2019 - All Rights Reserved</div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
