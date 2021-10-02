@extends('layouts.company')
@section('content')
    <!--// Main Banner \\-->
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-map mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>View Billing Info
            </div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-detail table table-hover table-striped table-bordered">
                                    <tr>
                                      <th>Full Name:</th>
                                      <td>John Doe</td>
                                    </tr>
                                    <tr>
                                      <th>Email:</th>
                                      <td>info@gmail.com</td>
                                    </tr>
                                    <tr>
                                      <th>Phone:</th>
                                      <td>+923332222111</td>
                                    </tr>
                                    <tr>
                                      <th>Address:</th>
                                      <td>Las Vegas, NV, USA</td>
                                    </tr>
                                    <tr>
                                      <th>Zip Code:</th>
                                      <td>54000</td>
                                    </tr>
                                </table>
                                <a href="/employeer/update-billing-information" class="tag">Edit Billing Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
