@extends('layouts.user_layout')
@section('title' , 'Payment')
@section('content')
    <div class="mm-subheader"><h1>Payment/Billing Information</h1></div>

    <!--// Main Content \\-->
    <div class="motivz-main-content">

        <!--// Main Section \\-->
        <div class="motivz-main-section payment-informationfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="payment-information">
                            <h2 class="payment-title">Payment Information</h2>
                            <section>
                                <form action="{{route('subscribe-now')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{$id}}">
                                    <div class="col-md-6" style="text-align: center;">
                                        <label style="margin: 0px 0px 25px">Paypal: </label>
                                        <button style="background: transparent" id="checkout-button-paypal">
                                            {{--<img src="/paypal.jpg" style="width: 100px;" alt="">--}}
                                            <button type="submit" class="btn btn-secondary"> Paypal </button>
                                        </button>
                                    </div>
                                </form>
                            </section>
                        </div>
                        <div class="payment-information">
                            <h2 class="payment-title">Billing Information</h2>
                            <section>
                                <form class="billing" action="">
                                    <ul>
                                        <li>
                                            <label>First Name</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </li>
                                        <li>
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </li>
                                        <li>
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="">
                                        </li>
                                        <li>
                                            <label>Phone</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </li>
                                        <li>
                                            <label>Address</label>
                                            <input type="text" name="location" id="location" data-role="tagsinput" class="tags_1 tags form-control" placeholder="" value="">
                                        </li>
                                        <li>
                                            <label>Zip Code</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </li>
                                        <!-- <li class="full"><input type="submit" value="Submit"></li> -->
                                    </ul>
                                </form>
                            </section>
                        </div>
                        <div class="clearfix"></div>
                        <div class="payment-information">
                            <h2 class="payment-title">Signup as a Company</h2>
                            <section>
                                <div class="login-layout">
                                    @if( session()->has('email_exists') )
                                        <div class="alert alert-danger">
                                            {{ session()->get('email_exists') }}
                                        </div>
                                    @endif
                                    <form id="company-registration-form" method="post" action="{{ route('company.register.verify') }}">
                                        @csrf
                                        <ul>
                                            <li>
                                                <i class="fa fa-envelope"></i>
                                                <input name="email" type="email" class="form-control" placeholder="Email">
                                                @error('email')
                                                <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                                @enderror
                                            </li>
                                            <li>
                                                <i class="fa fa-briefcase"></i>
                                                <input name="compnay_name" type="text" class="form-control" placeholder="Company Name">
                                                @error('compnay_name')
                                                <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                                @enderror
                                            </li>
                                            <li>
                                                <i class="fa fa-lock"></i>
                                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                                <label class="label_info"><i data-html="true" data-toggle="tooltip"  data-placement="top" title=" *Minimum 6 characters long&#013;*Must contain at least 1 special character (@,!,#,.)&#013;*Must contain at least 1 uppercase letter&#013;*Must contain at least 1 digit number" class="fa fa-question-circle"></i></label>
                                                @error('password')
                                                <label id="password_confirmation-error" class="error" for="email">{{ $message }}</label>
                                                @enderror
                                            </li>
                                            <li>
                                                <i class="fa fa-lock"></i>
                                                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                            </li>
                                            <li>
                                                <label for="terms_policy_checkbox"><input name="terms_policy_checkbox" type="checkbox" class="" id="terms_policy_checkbox"> I have read, and I accept, MyMotivz's <a href="/contact/terms-of-use" style="color: #4d9a10">Terms of Use</a> and <a href="/contact/privacy-policy" style="color: #4d9a10">Privacy Policy</a>.</label>
                                            </li>
                                            <li class="center"><input type="submit" value="Sign Up" class="submit"></li>
                                            <li class="center"><p>Already have an account? <a href="{{ route('user.login') }}">Sign In</a></p></li>
                                        </ul>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="purchase-summary">
                            <h2 class="summary-title">Purchase Summary</h2>
                            <section>
                                <div class="package-name">
                                    <h3>30-days Monster Premium Job Ad with Diversity Veteran Reach</h3>
                                    <h6>$170<small>/m</small></h6>
                                    <div class="clearfix"></div>
                                    <label>
                                        <a href="javascript:void(0)">Remove</a>
                                        <span>Quantity: <input type="number" min="1" max="5" value="1"></span>
                                    </label>
                                </div>
                                <ul>
                                    <li><strong>Subtotal:</strong> <span>$170</span></li>
                                    <li><a href="javascript:void(0)" class="click-promo">Have a promotion code?</a><input type="text" style="display: none;" class="input-field form-control"></li>
                                    <li class="total"><strong>Order Total: <span>$170</span></strong></li>
                                </ul>

                                <form action="#" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa fa-lock"></i>Place Order</button>
                                </form>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p><p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p><p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection

@section('script')

    <script src="{{asset('user/script/file-input/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/script/file-input/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/notify.min.js')}}"></script>
    <script>
        function submitPayPal() {

        }
    </script>
@endsection
