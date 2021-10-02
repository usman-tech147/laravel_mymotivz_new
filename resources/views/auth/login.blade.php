

@extends('layouts.admin-login-layout')

@section('content')
    @if(session()->has('Password'))
        <div class="alert alert-success custom-toster">
            {{ session()->get('Password') }}
        </div>
    @endif
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <form class="" method="POST" action="{{ route('login') }}">
                                <div class="modal-body">
                                    <div class="custom-logo">
                                        <img src="{{asset('assets/images/login-logo.png')}}" alt="">
                                    </div>

                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            <div>Welcome back,</div>
                                            <span>Please sign in to your account below.</span>
                                        </h4>

                                    </div>

                                         @csrf
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                      <!--   <div class="position-relative form-check">

                                    <label class="form-check-label" for="remember">
                                        Keep me logged in
                                    </label>

                                        </div> -->
                                        
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-left">
                                     @if (Route::has('password.request'))
                                    <a class="btn-lg btn btn-link" href="{{ route('password.request') }}">
                                        Recover Password
                                    </a>
                                @endif
                                    </div>
                                    <div class="float-right">
                                         <button type="submit" class="btn btn-primary btn-lg">
                                    Login to Dashboard
                                </button>
                                        
                                    </div>
                                    
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">© {{date('Y')}} - All Rights Reserved</div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
