@extends('layouts.admin')

@section('content')

    <div class="nk-content ">
        
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"> Events</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            <li><a s data-toggle="modal" data-target="#addEventPopup"
                                                    class="btn text-white fmdq_Gold"><em
                                                        class="icon ni ni-plus"></em><span>Add New Calendar</span></a></li>

                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="example-alert">
                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-icon alert-dismissible">
                                    <em class="icon ni ni-check-circle"></em> <strong> {{ \Session::get('success') }}<button
                                            class="close" data-dismiss="alert"></button>
                                </div>
                            @endif


                            @if (count($errors) > 0)
                                <div>
                                    <div class="alert alert-danger alert-icon alert-dismissible">
                                        <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button class="close" data-dismiss="alert"></button>
                                    </div>
                            @endif



                        </div>

                        <div class="card card-preview">
                            <div class="card-inner">
                                 <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search...">
                                 <br>
                                 <br>
                                 

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Event Title Code</th>
                                            <th>Category</th>
                                            <th>Start Date</th>


                                            <th>Status</th>


                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $event)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $event->event_title_code }}</td>
                                                <td>{{ $event->category_name }}</td>

                                                <td>{{ $event->start_date }}</td>



                                                <td>

                                                    @if ($event->admin_status == 0)
                                                        <span class="badge fmdq_Blue">Awaiting Approval<span>
                                                    @endif
                                                    @if ($event->admin_status == 1)
                                                        <span class="badge badge-primary">Approved</span>
                                                    @endif
                                                    @if ($event->admin_status == 2)
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif

                                                    @if ($event->admin_status == 5)
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif

                                                    @if ($event->admin_status == 4)
                                                        <span class="badge fmdq_Blue">Awaiting approval for status
                                                            change<span>
                                                    @endif



                                                    @if ($event->admin_status == 6)
                                                        <span class="badge fmdq_Blue">Awaiting approval for status
                                                            change<span>
                                                    @endif


                                                    @if ($event->admin_status == 3)
                                                        <span class="badge badge-warning">Awaiting approval to delete</span>
                                                    @endif
                                                </td>


                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">

                                                        <center>
                                                            <li style="align-content: center">
                                                                <div class="drodown">
                                                                    <a href="#"
                                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                                        data-toggle="dropdown"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">

                                                                        <ul class="link-list-opt no-bdr">
                                                                             @if ($event->admin_status == 0)
                                                                            <li>
                                                                                <a href="{{ route('pending_request', $event->id) }}">
                                                                                    <em
                                                                                        class="icon ni ni-edit"></em><span>View Changes</span>
                                                                                </a>
                                                                            </li>
                                                                            @endif

                                                                            <li>
                                                                                <a href="#" data-toggle="modal"
                                                                                    data-target="#view-{{ $event->id }}">
                                                                                    <em
                                                                                        class="icon ni ni-edit"></em><span>View </span>
                                                                                </a>
                                                                            </li>
                                                                            @if ($event->admin_status == 1 || $event->admin_status == 2)
                                                                                @can('event-edit')
                                                                                    <li>
                                                                                        <a href="#" data-toggle="modal"
                                                                                            data-target="#editUser-{{ $event->id }}">
                                                                                            <em
                                                                                                class="icon ni ni-edit"></em><span>Edit</span>
                                                                                        </a>
                                                                                    </li>
                                                                                @endcan




                                                                                @can('event-delete')
                                                                                    <li><a href="#" data-toggle="modal"
                                                                                            data-target="#deleteEvent-{{ $event->id }}"><em
                                                                                                class="icon ni ni-trash"></em><span>Delete</span></a>
                                                                                    </li>
                                                                                @endcan
                                                                            @endif


                                                                            @if ($event->admin_status == 0)
                                                                                @can('event-approve')
                                                                                    <li>
                                                                                        <a href="javascript:void();"
                                                                                            onclick="event.preventDefault(); document.getElementById('approve-{{ $event->id }}').submit();">
                                                                                            <em
                                                                                                class="icon ni ni-check-round-fill"></em>
                                                                                            <span>Approve</span>
                                                                                        </a>


                                                                                    </li>

                                                                                    <form id="approve-{{ $event->id }}"
                                                                                        action="{{ route('EventStatus', $event->id) }}"
                                                                                        method="POST" class="d-none">
                                                                                        @csrf
                                                                                        <input name="status" value="1">
                                                                                    </form>
                                                                                @endcan



                                                                                @can('event-reject')
                                                                                    <li><a href="#" data-toggle="modal"
                                                                                            data-target="#reject-{{ $event->id }}"><em
                                                                                                class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                    </li>
                                                                                @endcan
                                                                            @endif



                                                                            @if ($event->admin_status == 3)
                                                                                @can('event-approve')
                                                                                    <li>
                                                                                        <a href="javascript:void();"
                                                                                            onclick="event.preventDefault(); document.getElementById('approveDelete-{{ $event->id }}').submit();">
                                                                                            <em
                                                                                                class="icon ni ni-check-round-fill"></em>
                                                                                            <span>Approve</span>
                                                                                        </a>


                                                                                    </li>

                                                                                    <form
                                                                                        id="approveDelete-{{ $event->id }}"
                                                                                        action="{{ route('EventStatus', $event->id) }}"
                                                                                        method="POST" class="d-none">
                                                                                        @csrf
                                                                                        <input name="status" value="3">
                                                                                    </form>
                                                                                @endcan







                                                                                @can('event-reject')
                                                                                    <li><a href="#" data-toggle="modal"
                                                                                            data-target="#reject-{{ $event->id }}"><em
                                                                                                class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                    </li>
                                                                                @endcan
                                                                                <form
                                                                                    id="delete_request-{{ $event->id }}"
                                                                                    action="" method="POST"
                                                                                    class="d-none" style="display: none">
                                                                                    @csrf
                                                                                    <input name="status"
                                                                                        value="{{ $event->admin_status }}">
                                                                                </form>
                                                                            @endif

                                                                            @if ($event->admin_status == 1 || $event->admin_status == 5)
                                                                                <li><a href="#" data-toggle="modal"
                                                                                        data-target="#changeStatus-{{ $event->id }}"><em
                                                                                            class="icon ni ni-cross-circle-fill"></em><span>Change
                                                                                            Status</span></a>
                                                                                </li>
                                                                            @endif




                                                                            @if ($event->admin_status == 4)
                                                                                @can('event-approve')
                                                                                    <li>
                                                                                        <a href="javascript:void();"
                                                                                            onclick="event.preventDefault(); document.getElementById('approveDelete-{{ $event->id }}').submit();">
                                                                                            <em
                                                                                                class="icon ni ni-check-round-fill"></em>
                                                                                            <span>Approve</span>
                                                                                        </a>


                                                                                    </li>


                                                                                    <li><a href="#" data-toggle="modal"
                                                                                            data-target="#reject-{{ $event->id }}"><em
                                                                                                class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                    </li>

                                                                                    <form
                                                                                        id="approveDelete-{{ $event->id }}"
                                                                                        action="{{ route('EventStatus', $event->id) }}"
                                                                                        method="POST" class="d-none">
                                                                                        @csrf
                                                                                        <input name="status" value="4">
                                                                                    </form>
                                                                                @endcan
                                                                            @endif




                                                                            @if ($event->admin_status == 6)
                                                                                @can('event-approve')
                                                                                    <li>
                                                                                        <a href="javascript:void();"
                                                                                            onclick="event.preventDefault(); document.getElementById('ChangeStat-{{ $event->id }}').submit();">
                                                                                            <em
                                                                                                class="icon ni ni-check-round-fill"></em>
                                                                                            <span>Approve</span>
                                                                                        </a>


                                                                                    </li>


                                                                                    <li><a href="#" data-toggle="modal"
                                                                                            data-target="#reject-{{ $event->id }}"><em
                                                                                                class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                    </li>

                                                                                    <form id="ChangeStat-{{ $event->id }}"
                                                                                        action="{{ route('EventStatus', $event->id) }}"
                                                                                        method="POST" class="d-none">
                                                                                        @csrf
                                                                                        <input name="status" value="6">
                                                                                    </form>
                                                                                @endcan
                                                                            @endif


                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </center>
                                                    </ul>
                                                    {{-- <form id="approve-{{ $event->id }}" action="{{ route('event') }}"
                                                        method="POST" class="d-none" style="display: none">
                                                        @csrf
                                                        <input name="status" value="1">
                                                    </form> --}}



                                                    <div class="modal fade" role="dialog"
                                                        id="reject-{{ $event->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <a href="#" class="close" data-dismiss="modal"><em
                                                                        class="icon ni ni-cross-sm"></em></a>
                                                                <div class="modal-body modal-body-md">
                                                                    <h5 class="title">{{ $event->event_title_code }}</h5>
                                                                    <form method="POST"
                                                                        action="{{ route('EventStatus', $event->id) }}"
                                                                        id="rejectForm-{{ $event->id }}">
                                                                        @csrf
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="infomation">
                                                                                <div class="row gy-4">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">

                                                                                            <label>Rejection Note</label>
                                                                                            <input hidden name="status"
                                                                                                value="2">
                                                                                            <textarea required class="form-control" name="note"></textarea>


                                                                                        </div>
                                                                                    </div>



                                                                                    <div class="col-12">
                                                                                        <ul
                                                                                            class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                                                            <li>
                                                                                                {{-- <button type="submit"
                                                                                                    class="btn btn-primary">Submit</button> --}}
                                                                                                <button
                                                                                                    class="btn btn-lg btn-primary btn-block"
                                                                                                    id="rejectSubmitBtn-{{ $event->id }}"
                                                                                                    type="submit">
                                                                                                    <i class="fas fa-spinner fa-spin"
                                                                                                        style="display:none;"></i>
                                                                                                    <span
                                                                                                        class="btn-text">Submit</span>
                                                                                                </button>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- .tab-pane -->

                                                                        </div><!-- .tab-content -->

                                                                        <script>
                                                                            function loading(buttonId) {
                                                                                $("#" + buttonId + " .fa-spinner").show();
                                                                                $("#" + buttonId + " .btn-text").html("Processing...");
                                                                            }

                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                document.getElementById('rejectForm-{{ $event->id }}').addEventListener('submit', function(event) {
                                                                                    if (this.checkValidity() === false) {
                                                                                        event.preventDefault();
                                                                                        event.stopPropagation();
                                                                                    } else {
                                                                                        loading('rejectSubmitBtn-{{ $event->id }}');
                                                                                        document.getElementById('rejectSubmitBtn-{{ $event->id }}').disabled = true;
                                                                                    }
                                                                                    this.classList.add('was-validated');
                                                                                }, false);
                                                                            });
                                                                        </script>
                                                                    </form>
                                                                </div><!-- .modal-body -->
                                                            </div><!-- .modal-content -->
                                                        </div><!-- .modal-dialog -->
                                                    </div><!-- .modal -->
                                                </td>
                                            </tr>
                                            <!-- @@ Lead Add Modal @e -->
                                            <div class="modal fade" role="dialog" id="editUser-{{ $event->id }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $event->event_title_code }}</h5>
                                                            <a href="#" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('editEvent', $event->id) }}"
                                                                enctype="multipart/form-data"
                                                                id="editForm-{{ $event->id }}">
                                                                @csrf

                                                                <div class="row gx-4 gy-3">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-title">Event Title
                                                                                Code <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text"
                                                                                    name="event_title_code"
                                                                                    class="form-control" id="event-title"
                                                                                    required
                                                                                    value="{{ $event->event_title_code }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Start Date <span
                                                                                    style="color: red">*</span> </label>

                                                                            <div class="form-control-wrap">
                                                                                <div class="form-icon form-icon-left">
                                                                                    <em class="icon ni ni-calendar"></em>
                                                                                </div>
                                                                                <input type="text"
                                                                                    id="event-start-date"
                                                                                    class="form-control date-picker"
                                                                                    name="start_date"
                                                                                    data-date-format="yyyy-mm-dd" required
                                                                                    value="{{ $event->start_date }}">




                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-description">Event
                                                                                Description</label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea class="form-control" name="event_description" id="event-description">{{ $event->event_description }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Event
                                                                                Category <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="form-control-wrap">

                                                                                <select required name="category_id"
                                                                                    id="Category-dropdown-Edit-{{ $event->id }}"
                                                                                    class="form-control" required>

                                                                                    @foreach ($categories as $category)
                                                                                        <option
                                                                                            value="{{ $category->id }}"
                                                                                            @if ($category->id == $event->category_id) selected @endif>
                                                                                            {{ $category->name }}
                                                                                        </option>
                                                                                    @endforeach


                                                                                </select>

                                                                                <select hidden class="form-control"
                                                                                    name="category_name"
                                                                                    id="CategoryName-dropdown-Edit-{{ $event->id }}"
                                                                                    required>
                                                                                    <option
                                                                                        value="{{ $event->category_name }}">
                                                                                        {{ $event->category_name }}
                                                                                    </option>

                                                                                </select>

                                                                                <select hidden class="form-control"
                                                                                    name="category_color"
                                                                                    id="CategoryColor-dropdown-Edit-{{ $event->id }}"
                                                                                    required>
                                                                                    <option
                                                                                        value="{{ $event->category_color }}">
                                                                                        {{ $event->category_color }}
                                                                                    </option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Venue</label>
                                                                            <div class="form-control-wrap">

                                                                                <input type="text"
                                                                                    value="{{ $event->venue }}"
                                                                                    name="venue" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>






                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Issuer <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="form-control-wrap">

                                                                                <input type="text"
                                                                                    value="{{ $event->issuer }}"
                                                                                    name="issuer" class="form-control"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="">Issue
                                                                                Description</label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea class="form-control" name="issuer_description" id="issuer_description">{{ $event->issuer_description }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>






                                                                    <div class="col-12">
                                                                        <ul
                                                                            class="d-flex justify-content-between gx-4 mt-1">
                                                                            <li>


                                                                                <button
                                                                                    class="btn btn-lg btn-primary btn-block"
                                                                                    id="editSubmitBtn-{{ $event->id }}"
                                                                                    type="submit">
                                                                                    <i class="fas fa-spinner fa-spin"
                                                                                        style="display:none;"></i>
                                                                                    <span class="btn-text">Submit</span>
                                                                                </button>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>


                                                                <script>
                                                                    function loading(buttonId) {
                                                                        $("#" + buttonId + " .fa-spinner").show();
                                                                        $("#" + buttonId + " .btn-text").html("Processing...");
                                                                    }

                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        document.getElementById('editForm-{{ $event->id }}').addEventListener('submit', function(event) {
                                                                            if (this.checkValidity() === false) {
                                                                                event.preventDefault();
                                                                                event.stopPropagation();
                                                                            } else {
                                                                                loading('editSubmitBtn-{{ $event->id }}');
                                                                                document.getElementById('editSubmitBtn-{{ $event->id }}').disabled = true;
                                                                            }
                                                                            this.classList.add('was-validated');
                                                                        }, false);
                                                                    });
                                                                </script>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-dialog -->

                                                <script>
                                                    $('#Category-dropdown-Edit-{{ $event->id }}').on('change', function() {

                                                        var idCategory = this.value;
                                                        console.log(idCategory);
                                                        $("#CategoryName-dropdown-Edit-{{ $event->id }}").html('');
                                                        $.ajax({
                                                            url: "{{ url('fetch-category') }}",
                                                            type: "POST",
                                                            data: {
                                                                category_id: idCategory,
                                                                _token: '{{ csrf_token() }}'
                                                            },
                                                            dataType: 'json',
                                                            success: function(result) {
                                                                $('#CategoryName-dropdown-Edit-{{ $event->id }}').html();
                                                                $.each(result, function(key, value) {
                                                                    $("#CategoryName-dropdown-Edit-{{ $event->id }}").append(
                                                                        '<option value="' +
                                                                        value
                                                                        .name + '">' + value.name + '</option>');
                                                                });

                                                            }
                                                        });
                                                    });

                                                    /*------------------------------------------
                                                    --------------------------------------------
                                                    State Dropdown Change Event
                                                    --------------------------------------------
                                                    --------------------------------------------*/
                                                    $('#Category-dropdown-Edit-{{ $event->id }}').on('change', function() {
                                                        var idColor = this.value;
                                                        $("#CategoryColor-dropdown-Edit-{{ $event->id }}").html('');
                                                        $.ajax({
                                                            url: "{{ url('fetch-color') }}",
                                                            type: "POST",
                                                            data: {
                                                                category_id: idColor,
                                                                _token: '{{ csrf_token() }}'
                                                            },
                                                            dataType: 'json',
                                                            success: function(res) {
                                                                $('#CategoryColor-dropdown-Edit-{{ $event->id }}').html(
                                                                    '');
                                                                $.each(res, function(key, value) {
                                                                    $("#CategoryColor-dropdown-Edit-{{ $event->id }}").append(
                                                                        '<option value="' +
                                                                        value
                                                                        .color + '">' + value.color + '</option>');
                                                                });
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>




                                            <div class="modal fade" role="dialog" id="view-{{ $event->id }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $event->event_title_code }}
                                                            </h5>
                                                            <a href="#" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('editEvent', $event->id) }}"
                                                                class="form-validate is-alter"
                                                                enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="row gx-4 gy-3">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-title">Event Title
                                                                                Code <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="form-control-wrap">
                                                                                <input disabled type="text"
                                                                                    name="event_title_code"
                                                                                    class="form-control" id="event-title"
                                                                                    required
                                                                                    value="{{ $event->event_title_code }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Start Date <span
                                                                                    style="color: red">*</span></label>
                                                                            <div class="row gx-2">
                                                                                <div class="w-55">
                                                                                    <div class="form-control-wrap">
                                                                                        <div
                                                                                            class="form-icon form-icon-left">
                                                                                            <em
                                                                                                class="icon ni ni-calendar"></em>
                                                                                        </div>
                                                                                        <input disabled type="text"
                                                                                            id="event-start-date"
                                                                                            class="form-control date-picker"
                                                                                            name="start_date"
                                                                                            data-date-format="yyyy-mm-dd"
                                                                                            required
                                                                                            value="{{ $event->start_date }}">



                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="event-description">Event
                                                                                    Description</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea disabled class="form-control" name="event_description" id="event-description" required>{{ $event->event_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Event
                                                                                    Category <span
                                                                                        style="color: red">*</span></label>
                                                                                <div class="form-control-wrap">

                                                                                    <select disabled name="category_id"
                                                                                        id="Category-dropdown-Edit-{{ $event->id }}"
                                                                                        class="form-control" required>

                                                                                        @foreach ($categories as $category)
                                                                                            <option
                                                                                                value="{{ $category->id }}"
                                                                                                @if ($category->id == $event->category_id) selected @endif>
                                                                                                {{ $category->name }}
                                                                                            </option>
                                                                                        @endforeach


                                                                                    </select>

                                                                                    <select hidden class="form-control"
                                                                                        name="category_name"
                                                                                        id="CategoryName-dropdown-Edit-{{ $event->id }}"
                                                                                        required>
                                                                                        <option
                                                                                            value="{{ $event->category_name }}">
                                                                                            {{ $event->category_name }}
                                                                                        </option>

                                                                                    </select>

                                                                                    <select hidden class="form-control"
                                                                                        name="category_color"
                                                                                        id="CategoryColor-dropdown-Edit-{{ $event->id }}"
                                                                                        required>
                                                                                        <option
                                                                                            value="{{ $event->category_color }}">
                                                                                            {{ $event->category_color }}
                                                                                        </option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Venue</label>
                                                                                <div class="form-control-wrap">

                                                                                    <input disabled type="text"
                                                                                        value="{{ $event->venue }}"
                                                                                        name="venue"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>






                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Issuer <span
                                                                                        style="color: red">*</span></label>
                                                                                <div class="form-control-wrap">

                                                                                    <input disabled type="text"
                                                                                        value="{{ $event->issuer }}"
                                                                                        name="issuer"
                                                                                        class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                    for="">Issue
                                                                                    Description</label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea disabled class="form-control" name="issuer_description" id="issuer_description" required>{{ $event->issuer_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-dialog -->

                                            </div>
                                        @endforeach

                                    </tbody>
    </table>
    <!-- Pagination Links -->
   <!-- Custom Pagination -->
    @if ($data->hasPages())
    <nav>
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($data->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Prev"><span aria-hidden="true">&laquo;</span></a></li>
            @endif

            <!-- Page Numbers -->
            @foreach ($data->links()->elements[0] as $page => $url)
                <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Next Page Link -->
            @if ($data->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
    @endif


                            


    <script>
        function searchTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                let firstName = row.cells[1].textContent.toLowerCase();
                let lastName = row.cells[2].textContent.toLowerCase();
                
                if (firstName.includes(input) || lastName.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>

  


                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>
















    @foreach ($data as $event)
        <div class="modal fade" role="dialog" id="changeStatus-{{ $event->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Status</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form id="statusForm-{{ $event->id }}" method="POST"
                            action="{{ route('statusEvent', $event->id) }}" class="form-validate is-alter"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row gx-4 gy-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="event-title">Select Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" name="status" required>
                                                <option value="6" {{ $event->admin_status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="4" {{ $event->admin_status == 5 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <ul class="d-flex justify-content-between gx-4 mt-1">
                                        <li>
                                            <button id="statusSubmitBtn-{{ $event->id }}" type="submit"
                                                class="btn btn-success">
                                                <span id="button-text-{{ $event->id }}">Submit</span>
                                                <span class="spinner-border spinner-border-sm d-none"
                                                    id="spinner-{{ $event->id }}" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->

        <script>
            // Add event listener to the form's submit event
            document.getElementById('statusForm-{{ $event->id }}').addEventListener('submit', function(event) {
                const button = document.getElementById('statusSubmitBtn-{{ $event->id }}');
                const spinner = document.getElementById('spinner-{{ $event->id }}');
                const buttonText = document.getElementById('button-text-{{ $event->id }}');

                // Prevent default form submission for testing
                // Remove the line below in production
                // event.preventDefault();

                // Show spinner and disable the button
                spinner.classList.remove('d-none'); // Show spinner
                buttonText.innerText = "Processing..."; // Change button text
                button.disabled = true; // Disable the button
            });
        </script>
    @endforeach







    @foreach ($data as $event)
        <div class="modal fade" role="dialog" id="deleteEvent-{{ $event->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ $event->event_title_code }}
                        </h5>

                    </div>
                    <form method="POST" action=" {{ route('deleteEvent', $event->id) }}">
                        @csrf
                        <div class="modal-body modal-body-sm text-center">
                            <div class="nk-modal py-4">
                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                                <h4 class="nk-modal-title">Are You Sure ?</h4>
                                <div class="nk-modal-text mt-n2">

                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button id="deleteSubmitBtn-{{ $event->id }}" type="submit"
                                class="btn btn-success me-2">
                                <span class="spinner-border spinner-border-sm d-none" id="spinner-{{ $event->id }}"
                                    role="status" aria-hidden="true"></span>
                                <span id="button-text-{{ $event->id }}">Yes, Delete it</span>
                            </button>

                            <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup"
                                class="btn text-white fmdq_Blue">
                                Cancel
                            </button>
                        </div>

                    </form>
                </div>
            </div><!-- .modal-dialog -->
        </div>
        <!-- /.modal-dialog -->
        <script>
            document.getElementById('deleteSubmitBtn-{{ $event->id }}').addEventListener('click', function() {
                const button = document.getElementById('deleteSubmitBtn-{{ $event->id }}');
                const spinner = document.getElementById('spinner-{{ $event->id }}');
                const buttonText = document.getElementById('button-text-{{ $event->id }}');

                // Call the loading function if needed
                loading('deleteSubmitBtn-{{ $event->id }}');

                // Show spinner and update button text after a small delay
                setTimeout(() => {
                    if (spinner && buttonText) {
                        spinner.classList.remove('d-none'); // Show spinner
                        buttonText.innerText = "Processing..."; // Change button text
                    }
                    button.disabled = true; // Disable the button
                }, 50);
            });
        </script>
    @endforeach






















    <div class="modal fade" id="addEventPopup">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Calendar</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('addEvent') }}" class="form-validate is-alter"
                        enctype="multipart/form-data" id="eventForm">
                        @csrf

                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-title">Event Title Code <span
                                            style="color: red">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="event_title_code" class="form-control"
                                            id="event-title" required>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Start Date</label>
                                    {{-- <div class="row gx-2">
                                        <div class="w-55"> --}}
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="date" name="start_date" class="form-control" id="datePicker"
                                            min="<?php echo date('Y-m-d'); ?>" required />



                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="event-description">Event Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" name="event_description" id="event-description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Select Corporate Action <span
                                            style="color: red">*</span></label>
                                    <div class="form-control-wrap">

                                        <select required name="category_id" id="Category-dropdown" class="form-control">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>





                                        <select hidden class="form-control" name="category_name"
                                            id="CategoryName-dropdown" required>
                                            <option value=""></option>

                                        </select>

                                        <select hidden class="form-control" name="category_color"
                                            id="CategoryColor-dropdown" required>
                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>
                            </div>




                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Venue</label>
                                    <div class="form-control-wrap">

                                        <input type="text" name="venue" class="form-control">
                                    </div>
                                </div>
                            </div>






                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Issuer <span style="color: red">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="text" name="issuer" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="">Issue Description </label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" name="issuer_description" id="issuer_description"></textarea>
                                    </div>
                                </div>
                            </div>




                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">Event Picture</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input name="event_image" type="file" class="custom-file-input"
                                                id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <ul class="d-flex justify-content-between gx-4 mt-1">
                                    <li>
                                        <button id="saveButton" type="submit" class="btn fmdq_Gold">Save</button>
                                    </li>
                                    <li>
                                        <button id="resetEvent" data-dismiss="modal"
                                            class="btn fmdq_Blue">Cancel</button>
                                    </li>
                                </ul>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>









    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.getElementById('eventForm').addEventListener('submit', function(event) {
            const form = event.target;

            // Check if form is valid
            if (form.checkValidity()) {
                const saveButton = document.getElementById('saveButton');
                saveButton.disabled = true; // Disable the button
                saveButton.innerText = 'Saving...'; // Optionally, change button text
            } else {
                event.preventDefault(); // Prevent form submission if invalid
                form.reportValidity(); // Show validation messages
            }
        });


        $(document).ready(function() {








            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#Category-dropdown').on('change', function() {
                var idCategory = this.value;
                $("#CategoryName-dropdown").html('');
                $.ajax({
                    url: "{{ url('fetch-category') }}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#CategoryName-dropdown').html();
                        $.each(result, function(key, value) {
                            $("#CategoryName-dropdown").append('<option value="' + value
                                .name + '">' + value.name + '</option>');
                        });

                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#Category-dropdown').on('change', function() {
                var idColor = this.value;
                $("#CategoryColor-dropdown").html('');
                $.ajax({
                    url: "{{ url('fetch-color') }}",
                    type: "POST",
                    data: {
                        category_id: idColor,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#CategoryColor-dropdown').html(
                            '');
                        $.each(res, function(key, value) {
                            $("#CategoryColor-dropdown").append('<option value="' +
                                value
                                .color + '">' + value.color + '</option>');
                        });
                    }
                });
            });










        });
    </script>



@endsection
