@extends('layouts.user_layout')

@section('title' , 'Career Resources')

@section('content')
    <!--// Main Banner \\-->
    <div class="career-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('user.industry.insights') }}">Industry Insights</a>
                    <a href="{{ route('user.career.resources') }}" class="active">Career Resources</a>
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
                            <div class="grid-resources">
                                <ul class="row">
                                    <li class="col-md-6">
                                        <div class="grid-resources-text">
                                            <figure><a href="#"><img src="{{ asset('user/images/resources1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="#">Answer the Question Asked now</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulv inar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. </p>
                                                <a href="#" class="readmore">Read Mroe</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-6">
                                        <div class="grid-resources-text">
                                            <figure><a href="#"><img src="{{ asset('user/images/resources1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="#">Answer the Question Asked now</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulv inar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. </p>
                                                <a href="#" class="readmore">Read Mroe</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-6">
                                        <div class="grid-resources-text">
                                            <figure><a href="#"><img src="{{ asset('user/images/resources1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="#">Answer the Question Asked now</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulv inar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. </p>
                                                <a href="#" class="readmore">Read Mroe</a>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-md-6">
                                        <div class="grid-resources-text">
                                            <figure><a href="#"><img src="{{ asset('user/images/resources1.jpg') }}" alt=""></a></figure>
                                            <section>
                                                <h2><a href="#">Answer the Question Asked now</a></h2>
                                                <ul class="createby">
                                                    <li><time datetime="">June 29 . 2020</time></li>
                                                    <li>By <span>Advocacy Heidi</span></li>
                                                </ul>
                                                <div class="share-wrap">
                                                    <a href="javascript:void(0)" class="icon-share share"></a>
                                                    <ul>
                                                        <li><a href="#" target="_blank" class="fa fa-facebook"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-twitter"></a></li>
                                                        <li><a href="#" target="_blank" class="fa fa-linkedin"></a></li>
                                                    </ul>
                                                </div>
                                                <p>Nam ullamcorper bibendum aenean ligula pulv inar purus eu lacinia eges tas. Laoreet sodales dui cursus habitasse felis finibus praesent. </p>
                                                <a href="#" class="readmore">Read Mroe</a>
                                            </section>
                                        </div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="pagination-wrap">
                                    <a href="#" class="active">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#">4</a>
                                    <a href="#">5</a>
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
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