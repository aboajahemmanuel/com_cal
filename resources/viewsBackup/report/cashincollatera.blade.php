@extends('layouts.admin')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Cash Collateral And Non Cash Collateral Report</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>

                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="example-alert">



                        </div>


                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabItem5"><em
                                        class="icon ni ni-user"></em><span>Cash Collateral Report</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabItem6"><em
                                        class="icon ni ni-lock-alt"></em><span>Non-Cash Collateral Report</span></a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem5">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap table">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Denomination</th>
                                                    <th>Exchange Rate</th>
                                                    <th>Haircut Profile</th>
                                                    <th>Facevalue</th>
                                                    <th>Marketvalue</th>

                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $im_result)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>{{ $im_result->denomination }}</td>
                                                        <td><?php echo number_format($im_result->ex_rate, 2); ?></td>
                                                        <td><?php echo number_format($im_result->haircut_profile, 2); ?></td>
                                                        <td><?php echo number_format($im_result->facevalue, 2); ?></td>
                                                        <td><?php echo number_format($im_result->marketvalue, 2); ?></td>
                                                        <td>{{ $im_result->created_at }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>
                            <div class="tab-pane" id="tabItem6">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap table">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Security Type</th>
                                                    <th>Security</th>
                                                    <th>Haircut Profile</th>
                                                    <th>Facevalue</th>
                                                    <th>Security Price</th>
                                                    <th>Marketvalue</th>

                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data1 as $key => $im_result1)
                                                    <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>{{ $im_result1->securitytype }}</td>
                                                        <td>{{ $im_result1->security }}</td>
                                                        <td><?php echo number_format($im_result1->haircut_profile, 2); ?></td>
                                                        <td><?php echo number_format($im_result1->facevalue, 2); ?></td>
                                                        <td><?php echo number_format($im_result1->securityprice, 2); ?></td>
                                                        <td><?php echo number_format($im_result1->marketvalue, 2); ?></td>
                                                        <td>{{ $im_result1->created_at }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>
                            <div class="tab-pane" id="tabItem7">
                                <p>contnet</p>
                            </div>
                            <div class="tab-pane" id="tabItem8">
                                <p>contnet</p>
                            </div>
                        </div>



                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
