@extends('layouts.user_layout')
@section('title' , 'Industry Insights')

@section('content')
    <!--// Main Banner \\-->
    <div class="career-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('user.industry.insights') }}" class="active">Industry Insights</a>
                    <a href="{{ route('user.career.resources') }}">Career Resources</a>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Banner \\-->

    <!--// Main Content \\-->
    <div class="motivz-main-content" style="padding-top: 55px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" class="side-search">
                            <input type="text" placeholder="Search topic">
                            <input type="submit" value="Search">
                        </form>
                        <select name="" id="" class="sorting">
                            <option value="">Most Recent</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="resources-wrap">
                            <div class="grid-resources list-resources">
                                <ul class="row">
                                    <li class="col-md-12">
                                        <div class="grid-resources-text">
                                            <figure><a href="javascript:void(0)"><img src="{{ asset('user/images/insights-img1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="javascript:void(0)">Why We Cannot—and Do Not—Serve Our Patients Equally</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="https://twitter.com/" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="https://www.linkedin.com/" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulvinar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. Consequat justo erat laoreet odio ad. </p>
                                                <a href="javascript:void(0)" class="readmore">Read More</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <div class="grid-resources-text">
                                            <figure><a href="javascript:void(0)"><img src="{{ asset('user/images/insights-img1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="javascript:void(0)">Why We Cannot—and Do Not—Serve Our Patients Equally</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="https://twitter.com/" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="https://www.linkedin.com/" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulvinar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. Consequat justo erat laoreet odio ad. </p>
                                                <a href="javascript:void(0)" class="readmore">Read More</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <div class="grid-resources-text">
                                            <figure><a href="javascript:void(0)"><img src="{{ asset('user/images/insights-img1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="javascript:void(0)">Why We Cannot—and Do Not—Serve Our Patients Equally</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="https://twitter.com/" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="https://www.linkedin.com/" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulvinar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. Consequat justo erat laoreet odio ad. </p>
                                                <a href="javascript:void(0)" class="readmore">Read More</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <div class="grid-resources-text">
                                            <figure><a href="javascript:void(0)"><img src="{{ asset('user/images/insights-img1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="javascript:void(0)">Why We Cannot—and Do Not—Serve Our Patients Equally</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="https://twitter.com/" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="https://www.linkedin.com/" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulvinar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. Consequat justo erat laoreet odio ad. </p>
                                                <a href="javascript:void(0)" class="readmore">Read More</a>
                                            </section>
                                        </div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="pagination-wrap">
                                    <a href="javascript:void(0)" class="active">1</a>
                                    <a href="javascript:void(0)">2</a>
                                    <a href="javascript:void(0)">3</a>
                                    <a href="javascript:void(0)">4</a>
                                    <a href="javascript:void(0)">5</a>
                                    <a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                            @include('user.include.posts')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection