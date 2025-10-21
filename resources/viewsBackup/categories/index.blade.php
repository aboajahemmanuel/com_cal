@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Corporate Action Categories</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            @can('category-create')
                                                <li><a href="#" data-toggle="modal" data-target="#addUser"
                                                        class="btn text-white fmdq_Gold"><em
                                                            class="icon ni ni-plus"></em><span>Create New Corporate
                                                            Action</span></a></li>
                                            @endcan

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
                                <table class="datatable-init nowrap table">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Category Name</th>
                                            <th>Color Code</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            {{-- <th>Description</th> --}}


                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $category)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>


                                                    <input disabled type="color" id="color" name="color"
                                                        value="{{ $category->color }}"
                                                        class="select-calendar-theme form-control">



                                                </td>

                                                <td>
                                                    @if ($category->admin_status == 0)
                                                        <span class="badge fmdq_Blue">Awaiting Approval<span>
                                                    @endif
                                                    @if ($category->admin_status == 1)
                                                        <span class="badge badge-primary">Approved</span>
                                                    @endif
                                                    @if ($category->admin_status == 2)
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif


                                                    @if ($category->admin_status == 3)
                                                        <span class="badge badge-warning">Awaiting approval to delete</span>
                                                    @endif

                                                      @if ($category->admin_status == 5)
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif

                                                    @if ($category->admin_status == 4)
                                                        <span class="badge fmdq_Blue">Awaiting approval for status
                                                            change<span>
                                                    @endif



                                                    @if ($category->admin_status == 6)
                                                        <span class="badge fmdq_Blue">Awaiting approval for status
                                                            change<span>
                                                    @endif
                                                </td>
                                                <td>{{ $category->created_at }}</td>




                                                {{-- <td>


                                                    @if ($category->admin_status != 3)
                                                        @if ($category->admin_status != 0)
                                                            <span class="badge fmdq_Gold" data-toggle="modal"
                                                                data-target="#editUser-{{ $category->id }}">Edit</span>




                                                            <span class="badge fmdq_Blue" data-toggle="modal"
                                                                data-target="#deleteUser-{{ $category->id }}">Delete</span>


                                                            <span class="badge fmdq_Green" data-toggle="modal"
                                                                data-target="#changeStatus-{{ $category->id }}">Change
                                                                Status</span>
                                                        @endif
                                                    @endif


                                                    @if ($category->admin_status == 0)
                                                        <li>
                                                            <a href="javascript:void();" id="submit"
                                                                onclick="event.preventDefault(); document.getElementById('approve-{{ $category->id }}').submit();">
                                                                <em class="icon ni ni-check-round-fill"></em>
                                                                <span>Approve</span>
                                                            </a>


                                                        </li>

                                                        <span class="badge fmdq_Blue" data-toggle="modal"
                                                            data-target="#reject-{{ $category->id }}">Reject</span>
                                                    @endif



                                                    @if ($category->admin_status == 3)
                                                        <a href="#" id="submit"
                                                            onclick="document.getElementById('approve-{{ $category->id }}').submit();">
                                                            <span class="badge fmdq_Gold"
                                                                data-target="#editUser-{{ $category->id }}">Approve</span></a>




                                                        <span class="badge fmdq_Blue" data-toggle="modal"
                                                            data-target="#reject-{{ $category->id }}">Reject</span>




                                                        <form id="delete_request-{{ $category->id }}"
                                                            action="{{ route('CatStatus', $category->id) }}" method="POST"
                                                            class="d-none" style="display: none">
                                                            @csrf
                                                            <input name="status" value="{{ $category->admin_status }}">
                                                        </form>
                                                    @endif

                                                    



                                                </td> --}}


                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">

                                                        @can('event-create')
                                                            <li style="align-content: center">
                                                                <div class="drodown">
                                                                    <a href="#"
                                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                                        data-toggle="dropdown"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">

                                                                        <ul class="link-list-opt no-bdr">

                                                                            @if ($category->admin_status == 1 || $category->admin_status == 2)
                                                                                <li>
                                                                                    <a href="#" data-toggle="modal"
                                                                                        data-target="#editUser-{{ $category->id }}">
                                                                                        <em
                                                                                            class="icon ni ni-edit"></em><span>Edit</span>
                                                                                    </a>
                                                                                </li>






                                                                                <li><a href="#" data-toggle="modal"
                                                                                        data-target="#deleteUser-{{ $category->id }}"><em
                                                                                            class="icon ni ni-trash"></em><span>Delete</span></a>
                                                                                </li>
                                                                            @endif


                                                                            @if ($category->admin_status == 0)
                                                                                <li>
                                                                                    <a href="javascript:void();"
                                                                                        onclick="event.preventDefault(); document.getElementById('approve-{{ $category->id }}').submit();">
                                                                                        <em
                                                                                            class="icon ni ni-check-round-fill"></em>
                                                                                        <span>Approve</span>
                                                                                    </a>


                                                                                </li>

                                                                                <form id="approve-{{ $category->id }}"
                                                                                    action="{{ route('CatStatus', $category->id) }}"
                                                                                    method="POST" class="d-none">
                                                                                    @csrf
                                                                                    <input name="status" value="1">
                                                                                </form>





                                                                                <li><a href="#" data-toggle="modal"
                                                                                        data-target="#reject-{{ $category->id }}"><em
                                                                                            class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                </li>
                                                                            @endif



                                                                            @if ($category->admin_status == 3)
                                                                                <li>
                                                                                    <a href="javascript:void();"
                                                                                        onclick="event.preventDefault(); document.getElementById('approveDelete-{{ $category->id }}').submit();">
                                                                                        <em
                                                                                            class="icon ni ni-check-round-fill"></em>
                                                                                        <span>Approve</span>
                                                                                    </a>


                                                                                </li>

                                                                                <form id="approveDelete-{{ $category->id }}"
                                                                                    action="{{ route('CatStatus', $category->id) }}"
                                                                                    method="POST" class="d-none">
                                                                                    @csrf
                                                                                    <input name="status" value="3">
                                                                                </form>









                                                                                <li><a href="#" data-toggle="modal"
                                                                                        data-target="#reject-{{ $category->id }}"><em
                                                                                            class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                </li>

                                                                                <form id="delete_request-{{ $category->id }}"
                                                                                    action="" method="POST" class="d-none"
                                                                                    style="display: none">
                                                                                    @csrf
                                                                                    <input name="status"
                                                                                        value="{{ $category->admin_status }}">
                                                                                </form>
                                                                            @endif

                                                                            @if ($category->admin_status == 1 || $category->admin_status == 5)
                                                                                <li><a href="#" data-toggle="modal"
                                                                                        data-target="#changeStatus-{{ $category->id }}"><em
                                                                                            class="icon ni ni-cross-circle-fill"></em><span>Change
                                                                                            Status</span></a>
                                                                                </li>
                                                                            @endif




                                                                            

                                                                            @if ($category->admin_status == 4)
                                                                                <li>
                                                                                    <a href="javascript:void();"
                                                                                        onclick="event.preventDefault(); document.getElementById('approveDelete-{{ $category->id }}').submit();">
                                                                                        <em
                                                                                            class="icon ni ni-check-round-fill"></em>
                                                                                        <span>Approve</span>
                                                                                    </a>


                                                                                </li>

                                                                                <li><a href="#" data-toggle="modal"
                                                                                            data-target="#reject-{{ $category->id }}"><em
                                                                                                class="icon ni ni-cross-circle-fill"></em><span>Reject</span></a>
                                                                                    </li>

                                                                                <form id="approveDelete-{{ $category->id }}"
                                                                                    action="{{ route('CatStatus', $category->id) }}"
                                                                                    method="POST" class="d-none">
                                                                                    @csrf
                                                                                    <input name="status" value="4">
                                                                                </form>
                                                                            @endif




                                                                            @if ($category->admin_status == 6)
                                                                                <li>
                                                                                    <a href="javascript:void();"
                                                                                        onclick="event.preventDefault(); document.getElementById('ChangeStat-{{ $category->id }}').submit();">
                                                                                        <em
                                                                                            class="icon ni ni-check-round-fill"></em>
                                                                                        <span>Approve</span>
                                                                                    </a>


                                                                                </li>

                                                                                <form id="ChangeStat-{{ $category->id }}"
                                                                                    action="{{ route('CatStatus', $category->id) }}"
                                                                                    method="POST" class="d-none">
                                                                                    @csrf
                                                                                    <input name="status" value="6">
                                                                                </form>
                                                                            @endif


                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endcan
                                                    </ul>




                                                    <div class="modal fade" role="dialog"
                                                        id="reject-{{ $category->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <a href="#" class="close" data-dismiss="modal"><em
                                                                        class="icon ni ni-cross-sm"></em></a>
                                                                <div class="modal-body modal-body-md">
                                                                    <h5 class="title">{{ $category->event_title_code }}
                                                                    </h5>
                                                                    <form method="POST"
                                                                        action="{{ route('CatStatus', $category->id) }}">
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
                                                                                                <button type="submit"
                                                                                                    class="btn btn-primary">Submit</button>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- .tab-pane -->

                                                                        </div><!-- .tab-content -->
                                                                    </form>
                                                                </div><!-- .modal-body -->
                                                            </div><!-- .modal-content -->
                                                        </div><!-- .modal-dialog -->
                                                    </div><!-- .modal -->
                                                </td>
                                            </tr>


                                            <form id="approve-{{ $category->id }}"
                                                action="{{ route('CatStatus', $category->id) }}" method="POST"
                                                class="d-none" style="display: none">
                                                @csrf
                                                <input hidden name="status" value="1">
                                            </form>


                                            <div class="modal fade" role="dialog" id="reject-{{ $category->id }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <a href="#" class="close" data-dismiss="modal"><em
                                                                class="icon ni ni-cross-sm"></em></a>
                                                        <div class="modal-body modal-body-md">
                                                            <h5 class="title">{{ $category->name }}</h5>
                                                            <form method="POST"
                                                                action="{{ route('CatStatus', $category->id) }}">
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
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Submit</button>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- .tab-pane -->

                                                                </div><!-- .tab-content -->
                                                            </form>
                                                        </div><!-- .modal-body -->
                                                    </div><!-- .modal-content -->
                                                </div><!-- .modal-dialog -->
                                            </div><!-- .modal -->

                                            <div class="modal fade" role="dialog"
                                                id="changeStatus-{{ $category->id }}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Change Status</h5>
                                                            <a href="#" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('statusCategory', $category->id) }}"
                                                                class="form-validate is-alter"
                                                                enctype="multipart/form-data"
                                                                id="statusForm-{{ $category->id }}">
                                                                @csrf

                                                                <div class="row gx-4 gy-3">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-title">Select Status</label>
                                                                            <div class="form-control-wrap">
                                                                                <select class="form-control"
                                                                                    name="status">
                                                                                   <option value="6" {{ $category->admin_status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="4" {{ $category->admin_status == 5 ? 'selected' : '' }}>
                                                    Inactive</option>
                                                                                </select>


                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-12">
                                                                        <ul
                                                                            class="d-flex justify-content-between gx-4 mt-1">
                                                                            <li>
                                                                                <button
                                                                                    id="statusSubmitBtn-{{ $category->id }}"
                                                                                    type="submit"
                                                                                    class="btn btn-lg btn-primary btn-block">
                                                                                    <span
                                                                                        id="button-text-{{ $category->id }}">Submit</span>
                                                                                    <span
                                                                                        class="spinner-border spinner-border-sm d-none"
                                                                                        id="spinner-{{ $category->id }}"
                                                                                        role="status"
                                                                                        aria-hidden="true"></span>
                                                                                </button>
                                                                                {{-- <button
                                                                                    class="btn btn-lg btn-primary btn-block"
                                                                                    id="statusSubmitBtn-{{ $category->id }}"
                                                                                    type="submit">
                                                                                    <i class="fas fa-spinner fa-spin"
                                                                                        style="display:none;"></i>
                                                                                    <span class="btn-text">Submit</span>
                                                                                </button> --}}
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-dialog -->

                                                <script>
                                                    // Add event listener to the form's submit event
                                                    document.getElementById('statusForm-{{ $category->id }}').addEventListener('submit', function(event) {
                                                        const button = document.getElementById('statusSubmitBtn-{{ $category->id }}');
                                                        const spinner = document.getElementById('spinner-{{ $category->id }}');
                                                        const buttonText = document.getElementById('button-text-{{ $category->id }}');

                                                        // Prevent default form submission for testing
                                                        // Remove the line below in production
                                                        // event.preventDefault();

                                                        // Show spinner and disable the button
                                                        spinner.classList.remove('d-none'); // Show spinner
                                                        buttonText.innerText = "Processing..."; // Change button text
                                                        button.disabled = true; // Disable the button
                                                    });
                                                </script>


                                            </div><!-- .modal -->
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>




































    @foreach ($data as $category)
        <!-- @@ Lead Add Modal @e -->
        <div class="modal fade" role="dialog" id="editUser-{{ $category->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">{{ $category->name }}</h5>
                        {!! Form::model($category, [
                            'route' => ['categories.update', $category->id],
                            'method' => 'PATCH',
                            'id' => 'editForm-' . $category->id,
                        ]) !!}
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="infomation">
                                <div class="row gy-4">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="form-label" for="lead-name">Name <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input value="{{ $category->name }}" name="name" type="text"
                                                    class="form-control" id="lead-name">
                                            </div>
                                        </div>
                                    </div>






                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="form-label" for="lead-name">Code <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input value="{{ $category->code }}" name="code" type="text"
                                                    class="form-control" id="lead-name">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Select Colour <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input type="color" id="color" name="color"
                                                    value="{{ $category->color }}"
                                                    class="select-calendar-theme form-control">


                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-12">

                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button class="btn btn-lg btn-primary btn-block"
                                                    id="editSubmitBtn-{{ $category->id }}" type="submit">
                                                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                                    <span class="btn-text">Submit</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div><!-- .tab-pane -->

                        </div><!-- .tab-content -->
                        </form>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->
        <script> 
            function loading(buttonId) {
                $("#" + buttonId + " .fa-spinner").show();
                $("#" + buttonId + " .btn-text").html("Processing...");
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('editForm-{{ $category->id }}').addEventListener('submit', function(event) {
                    if (this.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        loading('editSubmitBtn-{{ $category->id }}');
                        document.getElementById('editSubmitBtn-{{ $category->id }}').disabled = true;
                    }
                    this.classList.add('was-validated');
                }, false);
            });
        </script>
    @endforeach


    @foreach ($data as $category)
        <div class="modal fade" id="deleteUser-{{ $category->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-sm text-center">
                        <div class="nk-modal py-4">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This will delete category details permanently.</p>
                            </div>
                            <ul class="d-flex justify-content-center gx-4 mt-4">
                                <li>
                                    <form action="{{ route('deleteCategory', $category->id) }}"
                                        id="deleteForm-{{ $category->id }}" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-lg btn-primary btn-block"
                                            id="deleteSubmitBtn-{{ $category->id }}" type="submit">
                                            <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                            <span class="btn-text">Yes, Delete it</span>
                                        </button>

                                    </form>
                                </li>
                                <li>

                                    <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup"
                                        class="btn btn-danger btn-dim">Cancel</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .modal -->

        <script>
            function loading(buttonId) {
                $("#" + buttonId + " .fa-spinner").show();
                $("#" + buttonId + " .btn-text").html("Processing...");
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('deleteForm-{{ $category->id }}').addEventListener('submit', function(event) {
                    if (this.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        loading('deleteSubmitBtn-{{ $category->id }}');
                        document.getElementById('deleteSubmitBtn-{{ $category->id }}').disabled = true;
                    }
                    this.classList.add('was-validated');
                }, false);
            });
        </script>
    @endforeach


    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title"> Create New Corporate Action</h5>
                    <br>
                    <form method="POST" action="{{ route('categories.store') }}" id="addForm">
                        @csrf
                        {{-- {!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'id' => 'categoryForm']) !!} --}}
                        <div class="row g-gs">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Corporate Action <span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="text" name="name" class="form-control" id="add-account"
                                            placeholder="Name" required>
                                    </div>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Code <span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="text" name="code" class="form-control" id="add-account"
                                            placeholder="Code" required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Select Colour <span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="color" id="color" name="color" value=""
                                            class="select-calendar-theme form-control">


                                    </div>
                                </div>
                            </div>





                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button class="btn btn-lg btn-primary btn-block" id="addSubmitBtn"
                                            type="submit">
                                            <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                            <span class="btn-text">Submit</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


    <script>
        function loading(buttonId) {
            $("#" + buttonId + " .fa-spinner").show();
            $("#" + buttonId + " .btn-text").html("Processing...");
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addForm').addEventListener('submit', function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    loading('addSubmitBtn');
                    document.getElementById('addSubmitBtn').disabled = true;
                }
                this.classList.add('was-validated');
            }, false);
        });
    </script>




@endsection
