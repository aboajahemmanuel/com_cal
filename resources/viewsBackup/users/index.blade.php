@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Users</h3>
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
                                            <th>Name</th>
                                            <th>Email</th>

                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>

                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $val)
                                                            <span
                                                                class="badge text-white fmdq_Grey">{{ $val }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->status == 0)
                                                        <span class="tb-status text-danger">Inactive</span>
                                                    @endif
                                                    @if ($user->status == 1)
                                                        <span class="tb-status text-fmdq_Green">Active</span>
                                                    @endif
                                                </td>

                                                <td>

                                                    @can('role-edit')
                                                        <span class="badge fmdq_Gold" data-toggle="modal"
                                                            data-target="#editUser-{{ $user->id }}">Edit</span>
                                                    @endcan

                                                    @can('role-delete')
                                                        <span class="badge fmdq_Blue" data-toggle="modal"
                                                            data-target="#deleteUser-{{ $user->id }}">Delete</span>
                                                    @endcan




                                                    @can('user-status')
                                                        <span class="badge fmdq_Green" data-toggle="modal"
                                                            data-target="#changeStatus-{{ $user->id }}">Change
                                                            Status</span>
                                                    @endcan



                                                </td>
                                            </tr>


                                            <div class="modal fade" role="dialog" id="changeStatus-{{ $user->id }}">
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
                                                                action="{{ route('statusUser', $user->id) }}"
                                                                class="form-validate is-alter"
                                                                enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="row gx-4 gy-3">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label"
                                                                                for="event-title">Select Status</label>
                                                                            <div class="form-control-wrap">
                                                                                <select class="form-control" name="status">
                                                                                    <option value="1"
                                                                                        {{ $user->status == 1 ? 'selected' : '' }}>
                                                                                        Active</option>
                                                                                    <option value="0"
                                                                                        {{ $user->status == 0 ? 'selected' : '' }}>
                                                                                        Inactive</option>
                                                                                </select>


                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-12">
                                                                        <ul
                                                                            class="d-flex justify-content-between gx-4 mt-1">
                                                                            <li>
                                                                                <button type="submit"
                                                                                    class="btn fmdq_Gold">
                                                                                    Submit</button>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!-- .modal-dialog -->

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



























    <!-- DELETE MODAL -->
    @foreach ($data as $key => $user)
        <div class="modal fade" id="deleteUser-{{ $user->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $user->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-body-sm text-center">
                        <div class="nk-modal py-4">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This User will be delete permanently.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('deleteUser', $user->id) }}">
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











    @foreach ($data as $user)
        <!-- @@ Lead Add Modal @e -->
        <div class="modal fade" role="dialog" id="editUser-{{ $user->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">{{ $user->name }}</h5>
                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH']) !!}
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="infomation">
                                <div class="row gy-4">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-label" for="lead-name">Name</label>
                                            <div class="form-control-wrap">

                                                <input value="{{ $user->name }}" name="name" type="text"
                                                    class="form-control" id="lead-name"
                                                    placeholder="e.g. Abu Bin Ishtiyak">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="open-deal">Email</label>
                                            <input name="email" value="{{ $user->email }}" type="text"
                                                class="form-control" id="open-deal" placeholder="example@mail.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="open-deal">Role</label>
                                            <?php
                                            $id = $user->id;
                                            
                                            $user = \App\Models\User::find($id);
                                            $roles = Spatie\Permission\Models\Role::pluck('name', 'name')->all();
                                            $userRole = $user->roles->pluck('name', 'name')->all();
                                            ?>
                                            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                                        </div>
                                    </div>


                                    <div class="col-12">

                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
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
    @endforeach


    @foreach ($data as $user)
        <div class="modal fade" id="deleteUser-{{ $user->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-sm text-center">
                        <div class="nk-modal py-4">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This will delete user details permanently.</p>
                            </div>
                            <ul class="d-flex justify-content-center gx-4 mt-4">
                                <li>
                                    <form enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <button type="submit" class="btn text-white fmdq_Gold">Yes, Delete it</button>
                                    </form>
                                </li>
                                <li>

                                    <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup"
                                        class="btn text-white fmdq_Blue">Cancel</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .modal -->
    @endforeach


    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add User</h5>
                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                    <div class="row g-gs">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Name</label>
                                <div class="form-control-wrap">

                                    <input type="text" name="name" class="form-control" id="add-account"
                                        placeholder="Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Email</label>
                                <div class="form-control-wrap">

                                    <input type="email" name="email" class="form-control" id="add-account"
                                        placeholder="Email" required>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Password</label>
                                    <div class="form-control-wrap">
                                        
                                        <input type="password" name="password"  class="form-control" id="add-account"  required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-account">Confrim Password</label>
                                    <div class="form-control-wrap">
                                        <input type="password" name="password_confirmation"  class="form-control" id="add-account"  required>
                                    </div>
                                </div>
                            </div> --}}



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-issue">Role</label>
                                <div class="form-control-wrap">
                                    {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>
                        </div>

                        <input hidden name="usertype" value="internal" type="text">


                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>



@endsection
