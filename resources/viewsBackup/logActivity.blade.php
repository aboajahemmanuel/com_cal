@extends('layouts.admin')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Activity Logs</h3>
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
                       

                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subject</th>
                                            <th>IP</th>


                                            <th width="300px">User Agent</th>

                                            <th>User Email</th>
                                            <th>Created at </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($logs->count())
                                            @foreach ($logs as $key => $log)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $log->subject }}</td>


                                                    <td class="">{{ $log->ip }}</td>
                                                    <td class="text-danger">{{ $log->agent }}</td>

                                                    <td>{{ $log->user_email }}</td>
                                                    <td>{{ $log->created_at }}</td>

                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
