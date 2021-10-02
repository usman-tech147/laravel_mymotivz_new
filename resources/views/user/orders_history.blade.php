@extends('layouts.company')
@section('content')
    <!--// Main Banner \\-->
    <div class="app-main__inner">
        <div class="card-header-tab card-header">
            <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-map mr-3 text-muted opacity-6" style="font-size: 35px; color: #4d9a10 !important;"> </i>Orders history</div>
        </div>
        <div class="tabs-animation">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Expiry Date</th>
                                        <th>Package Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>09/09/2021</td>
                                        <td>09/10/2021</td>
                                        <td>Team Essential</td>
                                        <td>$330</td>
                                        <td><a href="#" class="tag">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>09/09/2021</td>
                                        <td>09/10/2021</td>
                                        <td>Team Essential</td>
                                        <td>$330</td>
                                        <td><a href="#" class="tag">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>09/09/2021</td>
                                        <td>09/10/2021</td>
                                        <td>Team Essential</td>
                                        <td>$330</td>
                                        <td><a href="#" class="tag">Delete</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
