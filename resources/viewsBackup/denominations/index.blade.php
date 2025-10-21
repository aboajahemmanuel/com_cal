@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Eligible Currencies</h3>
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
                                        <th>Denomination Name</th>
                                        <th>Exchange Rate</th>
                                        <th>Haircut Profile</th>



                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $Denomination)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $Denomination->name }}</td>
                                            <td>
                                                <?php echo number_format($Denomination->rate, 2); ?>
                                            </td>

                                            <td>
                                                <?php echo number_format($Denomination->haircut_profile, 2); ?>
                                            </td>

                                            {{-- <td>{{ $Denomination->rate }}</td>
                                            <td>{{ $Denomination->haircut_profile }}</td> --}}




                                            <td>




                                                <a href="#"class="btn text-white fmdq_Gold" data-toggle="modal"
                                                    data-target="#editUser-{{ $Denomination->id }}"><span>Edit</span></a>



                                                <a href="#"class="btn text-white fmdq_Blue" data-toggle="modal"
                                                    data-target="#deleteUser-{{ $Denomination->id }}"><span>Delete</span></a>


                                                {{-- <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser-{{$Denomination->id}}" style="color: white;">Delete</a> --}}

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



























    <!-- DELETE MODAL -->
    @foreach ($data as $key => $Denomination)
        <div class="modal fade" id="deleteUser-{{ $Denomination->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $Denomination->name }}
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
                        <form method="POST" action="{{ route('deletedenomination', $Denomination->id) }}">
                            @csrf
                            <button type="submit" id="deleteOrg" class="btn text-white fmdq_Gold">Yes, Delete it</button>
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











    @foreach ($data as $Denomination)
        <!-- @@ Lead Add Modal @e -->
        <div class="modal fade" role="dialog" id="editUser-{{ $Denomination->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">{{ $Denomination->name }}</h5>
                        {!! Form::model($Denomination, ['route' => ['denominations.update', $Denomination->id], 'method' => 'PATCH']) !!}
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="infomation">
                                <div class="row gy-4">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="form-label" for="lead-name">Name <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input value="{{ $Denomination->name }}" name="name" type="text"
                                                    class="form-control " id="lead-name">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Exchange Rate <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input type="text" name="rate" step="0.01"
                                                    value="{{ $Denomination->rate }}"
                                                    class="form-control formattedNumberField" id="add-account" required>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Haircut Profile <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input type="number" name="haircut_profile"
                                                    value="{{ $Denomination->haircut_profile }}" step="0.01"
                                                    class="form-control" id="add-account" min="0" required>
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





    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Denomination</h5>
                    {!! Form::open(['route' => 'denominations.store', 'method' => 'POST']) !!}
                    <div class="row g-gs">

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
                                <label class="form-label" for="add-account">Exchange Rate <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <input type="text" name="rate" class="form-control formattedNumberField"
                                        step="0.01" id="add-account" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Haircut Profile <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <input type="number" name="haircut_profile" step="0.01" min="0"
                                        class="form-control" id="add-account" required>
                                </div>
                            </div>
                        </div>



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
