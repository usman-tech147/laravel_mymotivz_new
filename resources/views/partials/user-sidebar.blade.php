@section('user-sidebar')
<div class="col-md-3">
                            <div class="job-typo-wrap">
                                <div class="job-employer-dashboard-nav">
                                    <figure>
                                        <a href="#" class="employer-dashboard-thumb"><img src="{{ asset('user/images/avatar.png') }}" alt=""></a>
                                        <figcaption>
                                            <div class="job-fileUpload">
                                                <span><i class="fa fa-plus"></i> Upload Photo</span>
                                                <input type="file" class="job-upload">
                                            </div>
                                            <h2>M. Arslan</h2>
                                            <span class="job-dashboard-subtitle">Front-end Developer</span>
                                        </figcaption>
                                    </figure>
                                    <ul>
                                        <li class="active"><a href="profile-settings.html"><i class="fa fa-user"></i> My Profile</a></li>
                                        <li><a href="favorite-jobs.html"><i class="fa fa-heart"></i> Saved jobs</a></li>
                                        <li><a href="applied-jobs.html"><i class="fa fa-briefcase"></i> Applied jobs</a></li>
                                        <li><a href="changed-password.html"><i class="fa fa-lock"></i> Change Password</a></li>
                                        <li><a href="index.html"><i class="fa fa-share"></i> Logout</a></li>
                                        <li><a href="#exampleModal" data-toggle="modal" class="bottom-btn">Connect with a Career Developer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
 @endsection