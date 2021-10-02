@extends('layouts.user_layout')
@section('title' , 'Job Details')
@section('content')
    <div class="mm-subheader"><h1>View Job Details</h1></div>

    <!--// Main Content \\-->
    <div class="motivz-main-content" style="padding-top: 30px;">

        <!--// Main Section \\-->
        <div class="motivz-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jobs-details">
                            <h2 class="jobdetail-title">Job Position</h2>
                            <section>
                                <table>
                                    <tr><th>Job Title:</th><td>Front-end Developer</td></tr>
                                    <tr><th>Job Type:</th><td>Full-Time</td></tr>
                                    <tr><th>Job Location:</th><td>Lahore, Pakistan</td></tr>
                                    <tr><th>Number of Hires:</th><td>5</td></tr>
                                    <tr><th>Apply Before:</th><td>18/09/2022</td></tr>
                                    <tr><th>Job Description:</th><td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</td></tr>
                                </table>
                                <a href="/employeer/post-job" class="simple-btn">Edit Job Position</a>
                            </section>
                            <div class="clearfix"></div>
                        </div>
                        <div class="jobs-details">
                            <h2 class="jobdetail-title">Job Qualifications</h2>
                            <section>
                                <table>
                                    <tr><th>Industry:</th><td>Front-end Developer</td></tr>
                                    <tr><th>Experience Level:</th><td>Full-Time</td></tr>
                                    <tr><th>Education:</th><td>Lahore, Pakistan</td></tr>
                                    <tr><th>Required Skills:</th><td>5</td></tr>
                                    <tr><th>Licensure/Certification:</th><td>N/A</td></tr>
                                </table>
                                <a href="/employeer/job-qualification" class="simple-btn">Edit Job Qualifications</a>
                            </section>
                            <div class="clearfix"></div>
                        </div>
                        <div class="jobs-details">
                            <h2 class="jobdetail-title">Job Pay & Benefits</h2>
                            <section>
                                <table>
                                    <tr><th>Compensation:</th><td>Front-end Developer</td></tr>
                                    <tr><th>Job Benefits:</th><td>Full-Time</td></tr>
                                </table>
                                <a href="/employeer/job-benefits" class="simple-btn">Edit Pay & Benefits</a>
                            </section>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->
@endsection

@section('js')
    <script>




    </script>
@endsection
