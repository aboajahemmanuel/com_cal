@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Contracts</h3>
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
                                        <th>Contract Name</th>
                                        <th>Category</th>
                                        <th>Market Name</th>
                                        <th>Nominal Value</th>
                                        <th>IM Rate (%)</th>
                                        <th>Contract Type</th>
                                        <th>Date Created</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $contract)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $contract->name }}</td>
                                            <td>{{ optional($contract->category)->name }}</td>
                                            <td>{{ optional($contract->market)->name }}</td>

                                            <td>
                                                <?php echo number_format($contract->nominal_value, 2); ?>
                                            </td>

                                            <td>
                                                {{ $contract->im_Rate }}
                                            </td>

                                            <td>
                                                @if ($contract->contract_type == 1)
                                                    <p>Percentage</p>
                                                @endif
                                                @if ($contract->contract_type == 2)
                                                    <p>Parallel</p>
                                                @endif
                                            </td>

                                            {{-- <td>{{ $contract->nominal_value }}</td> --}}
                                            {{-- <td>{{ $contract->im_Rate }}</td> --}}
                                            <td>{{ $contract->created_at }}</td>



                                            <td>




                                                <a href="#"class="btn text-white fmdq_Gold" data-toggle="modal"
                                                    data-target="#editUser-{{ $contract->id }}"><span>Edit</span></a>



                                                <a href="#"class="btn text-white fmdq_Blue" data-toggle="modal"
                                                    data-target="#deleteUser-{{ $contract->id }}"><span>Delete</span></a>


                                                {{-- <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser-{{$contract->id}}" style="color: white;">Delete</a> --}}

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
    @foreach ($data as $key => $contract)
        <div class="modal fade" id="deleteUser-{{ $contract->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $contract->name }}
                        </h5>

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
                        <form method="POST" action="{{ route('deleteContract', $contract->id) }}">
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











    @foreach ($data as $contract)
        <!-- @@ Lead Add Modal @e -->
        <div class="modal fade" role="dialog" id="editUser-{{ $contract->id }}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">{{ $contract->name }}</h5>
                        {!! Form::model($contract, ['route' => ['contracts.update', $contract->id], 'method' => 'PATCH']) !!}
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="infomation">
                                <div class="row gy-4">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="form-label" for="lead-name">Name <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input value="{{ $contract->name }}" name="name" type="text"
                                                    class="form-control" id="lead-name" placeholder="e.g. Abu Bin Ishtiyak">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Nominal Value <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input step="0.01" type="text" name="nominal_value"
                                                    value="{{ $contract->nominal_value }}"
                                                    class="form-control formattedNumberField" id="add-account" required>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">IM Rate <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">

                                                <input step="0.01" type="text" name="im_Rate"
                                                    value="{{ $contract->im_Rate }}"
                                                    class="form-control formattedNumberField" id="add-account" required>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Select Market <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">



                                                <select class="form-control" name="market_id" id="country-dropdown2">
                                                    <option value="">-- Select Market --</option>

                                                    @foreach ($countries as $market)
                                                        <option value="{{ $market->id }}"
                                                            @if ($market->id == $contract->market_id) selected @endif>
                                                            {{ $market->name }}
                                                        </option>
                                                    @endforeach

                                                    {{-- @foreach ($countries as $market)
                                                        <option value="{{ $market->id }}">
                                                            {{ $market->name }}
                                                        </option>
                                                    @endforeach --}}

                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Select Category <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">



                                                <select class="form-control" name="category_id" id="state-dropdown2">
                                                    <option value="{{ $contract->category_id }}">
                                                        {{ optional($contract->category)->name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="add-account">Select Formular Pattern <span
                                                    style="color: red;">*</span></label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" name="contract_type" required>

                                                    <option value="{{ $contract->contract_type }}">
                                                        @if ($contract->contract_type == 1)
                                                            <p>Percentage</p>
                                                        @endif
                                                        @if ($contract->contract_type == 2)
                                                            <p>Parallel</p>
                                                        @endif
                                                    </option>
                                                    <option value="1">Percentage</option>
                                                    <option value="2">Parallel</option>

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


    @foreach ($data as $contract)
        <div class="modal fade" id="deleteUser-{{ $contract->id }}">
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
                                        <button type="submit" class="btn btn-success">Yes, Delete it</button>
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
    @endforeach


    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Contract</h5>
                    {!! Form::open(['route' => 'contracts.store', 'method' => 'POST']) !!}
                    <div class="row g-gs">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Contract Name <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <input type="text" name="name" class="form-control" id="add-account"
                                        placeholder="Name" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Nominal Value <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <input type="text" step="0.01" name="nominal_value"
                                        class="form-control formattedNumberField" id="add-account" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">IM Rate <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <input type="text" step="0.01" name="im_Rate"
                                        class="form-control formattedNumberField" id="add-account" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Select Market <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">



                                    <select class="form-select" name="market_id" id="country-dropdown" required>
                                        <option value="">-- Select Market --</option>
                                        @foreach ($countries as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Select Category <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">

                                    <select class="form-select" name="category_id" id="state-dropdown" required>
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="add-account">Select Formular Pattern <span
                                        style="color: red;">*</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="contract_type" required>
                                        <option value="">----</option>
                                        <option value="1">Percentage</option>
                                        <option value="2">Parallel</option>

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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#country-dropdown').on('change', function() {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('fetch-states') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });


            $('#state-dropdown').on('change', function() {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('fetch-cities') }}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>






    <script>
        $(document).ready(function() {


            $('#country-dropdown2').on('change', function() {
                var idCountry = this.value;
                $("#state-dropdown2").html('');
                $.ajax({
                    url: "{{ url('fetch-states') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown2').html(
                            '<option value="">-- Select State --</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown2").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });


            $('#state-dropdown2').on('change', function() {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('fetch-cities') }}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>


@endsection
