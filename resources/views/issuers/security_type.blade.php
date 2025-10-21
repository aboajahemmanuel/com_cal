@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Security Type</h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            <li><a href="#" data-toggle="modal" data-target="#addUser"
                                                    class="btn text-white fmdq_Gold"><em
                                                        class="icon ni ni-plus"></em><span>Add New</span></a></li>

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

                            @if (session('error'))
                                <div class="alert alert-danger alert-icon alert-dismissible">
                                    <em class="icon ni ni-check-circle"></em> <strong> {{ session('error') }}<button
                                            class="close" data-dismiss="alert"></button>
                                </div>



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
                                        <th>Security ID</th>
                                        <th>Name</th>
                                        <th>Denomination</th>
                                        <th>Date Created</th>



                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $security_type)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td> {{ $security_type->id }}</td>
                                            <td>{{ $security_type->name }}</td>
                                            <td>{{ $security_type->denominations->name }}</td>
                                            <td>{{ $security_type->created_at }}</td>





                                            <td>




                                                <a href="#"class="btn text-white fmdq_Gold" data-toggle="modal"
                                                    data-target="#editUser-{{ $security_type->id }}"><span>Edit</span></a>



                                                <a href="#"class="btn text-white fmdq_Blue" data-toggle="modal"
                                                    data-target="#deleteUser-{{ $security_type->id }}"><span>Delete</span></a>


                                                {{-- <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser-{{$security_type->id}}" style="color: white;">Delete</a> --}}

                                            </td>
                                        </tr>
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








































    @foreach ($data as $security_type)
        <!-- @@ Lead Add Modal @e -->
        <div class="modal fade" role="dialog" id="editUser-{{ $security_type->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">{{ $security_type->name }}</h5>
                        <form method="post" action="{{ route('update_security_type', $security_type->id) }}">


                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="infomation">
                                    <div class="row gy-4">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="add-account">Security ID <span
                                                        style="color: red;">*</span></label>
                                                <div class="form-control-wrap">

                                                    <input type="number" value="{{ $security_type->id }}" name="id"
                                                        class="form-control" id="add-account" required>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label class="form-label" for="lead-name">Name <span
                                                        style="color: red;">*</span></label>
                                                <div class="form-control-wrap">

                                                    <input value="{{ $security_type->name }}" name="name" required
                                                        type="text" class="form-control" id="lead-name">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="add-account">Denomination<span
                                                        style="color: red;">*</span></label>
                                                <div class="form-control-wrap">

                                                    <select class="form-select" name="denominations_id" id=""
                                                        required>
                                                        <option value="">-- Select Security Type --</option>

                                                        @foreach ($denominations as $demo)
                                                            <option value="{{ $demo->id }}"
                                                                @if ($demo->id == $security_type->denominations_id) selected @endif>
                                                                {{ $demo->name }}
                                                            </option>
                                                        @endforeach



                                                    </select>




                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">

                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
                                                </li>
                                            </ul>
                                        </div>
                        </form>
                    </div>
                </div><!-- .tab-pane -->

            </div><!-- .tab-content -->
            </form>
        </div><!-- .modal-body -->
        </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
        </div><!-- .modal -->
    @endforeach


    @foreach ($data as $key => $security_type)
        <div class="modal fade" id="deleteUser-{{ $security_type->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $security_type->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-body-sm text-center">
                        <div class="nk-modal py-4">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This Data will be delete permanently.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('deletesecurity_type', $security_type->id) }}">
                            @csrf
                            <button type="submit" id="deleteOrg" class="btn text-white fmdq_Gold">Yes, Delete
                                it</button>
                        </form>
                        <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup"
                            class="btn text-white fmdq_Blue">Cancel</button>


                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach



    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Security Type</h5>
                    <form action="{{ route('add_security_type') }}" method="post">
                        @csrf

                        <div class="row g-gs">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Security ID <span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="number" name="id" class="form-control" id="add-account"
                                            required>
                                    </div>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Name <span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <input type="text" name="name" class="form-control" id="add-account"
                                            placeholder="Name" required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Denomination<span
                                            style="color: red;">*</span></label>
                                    <div class="form-control-wrap">

                                        <select class="form-select" name="denominations_id" id="" required>
                                            <option value="">-- Select Denomination --</option>

                                            @foreach ($denominations as $demo)
                                                <option value="{{ $demo->id }}">
                                                    {{ $demo->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>





                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>





@endsection
