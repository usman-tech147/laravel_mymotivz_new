@extends('admin.layouts.layouts')
@section('title', 'New Job')
@section('content')
    <div class="app-main__inner">
        <div class="motivz-main-section motivz-typo-wrapfull">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="motivz-typo-wrap candidate">
                            <figure class="motivz-jobdetail-list">
                                <span class="motivz-jobdetail-listthumb"><small style="background-position: top; background-image: url(' http://localhost:8000/user/images/avatar1.png ');"></small></span>
                                <figcaption>
                                    <h2>usman <small>( bbb )</small></h2>
                                    <ul class="motivz-jobdetail-options">
                                        <li><i style="color:#999999;" class="fa fa-map-marker"></i>Destin, FL, USA</li>
                                        <li><i class="fa fa-envelope"></i> usman.softenica@gmail.com</li>
                                        <li><i class="fa fa-phone"></i> (123) 456-7899</li>
                                    </ul>
                                    <ul class="social-net">
                                        <li><a href="www.example.com" target="_blank" class="fa fa-linkedin"></a></li>
                                    </ul>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mm-motivz-jobdetail-content">
                            <div class="mm-motivz-content-title"><h2>Professional Summary</h2></div>
                            <div class="mm-motivz-description">
                                <p>professional summary updted</p>
                            </div>
                            <div class="mm-motivz-content-title"><h2>Skills</h2></div>
                            <div class="mm-motivz-jobdetail-tags" style="margin: 0px 0px 30px;">
                                <a href="javascript:void(0)">skill 1</a>
                                <a href="javascript:void(0)">skill 2</a>
                            </div>
                            <div class="mm-motivz-content-title"><h2>Basic Information</h2></div>
                            <div class="basic-information">
                                <ul>
                                    <li>
                                        <span>Job Title</span>

                                        <p><span>bbb</span></p>
                                    </li>
                                    <li>
                                        <span>Location</span>
                                        <p>Destin, FL, USA</p>






                                    </li>
                                    <li>
                                        <span>Interest</span>
                                        <p><span>interst 1</span><span>ntrest 2</span></p>
                                    </li>
                                    <li>
                                        <span>Licensure/Certification</span>
                                        <p><span>certificate 1</span><span>certificate 2</span><span>certificate 3</span></p>
                                    </li>
                                    <li>
                                        <span>Experience</span>
                                        <p>Intermediate</p>
                                    </li>
                                    <li>
                                        <span>Education</span>
                                        <p>High School Diploma</p>                                     </li>
                                    <li>
                                        <span>Industry</span>
                                        <p>Construction</p>
                                    </li>
                                    <li>
                                        <span>Authorization Status</span>
                                        <p>I am authorized to work in the U.S for any employer</p>
                                    </li>

                                </ul>
                            </div>
                            <a href="/files/sample-2021_07_30-00-28-05.pdf" id="print" class="simple-btn" download="">Download Resume</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




