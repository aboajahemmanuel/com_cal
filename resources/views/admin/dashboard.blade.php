@extends('layouts.admin')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                                <div class="nk-block-des text-soft">
                                    {{-- <p>Welcome to DashLite Dashboard Template.</p> --}}
                                </div>
                            </div><!-- .nk-block-head-content -->

                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">



                            <div class="col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Corporate Action Categories
                                                </h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title="Total Booking"></em>
                                            </div>
                                        </div>
                                        <div class="card-amount">
                                            <span class="amount"> {{ $category }}</span>

                                        </div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">Active</div>
                                                    <div class="amount">{{ $category_active }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">Inactive</div>
                                                    <div class="amount">{{ $category_inactive }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalBooking"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div>
                            <div class="col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="title">Events Count</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title="Total Events"></em>
                                            </div>
                                        </div>
                                        <div class="card-amount">
                                            <span class="amount"> {{ $events }}</span>

                                        </div>
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title">Active</div>
                                                    <div class="amount">{{ $events_active }}</div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title">Inactive</div>
                                                    <div class="amount">{{ $events_inactive }}</div>
                                                </div>
                                            </div>
                                            <div class="invest-data-ck">
                                                <canvas class="iv-data-chart" id="totalBooking"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div>



                        </div><!-- .row -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
