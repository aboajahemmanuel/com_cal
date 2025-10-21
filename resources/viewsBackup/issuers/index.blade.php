@extends('layouts.admin')

@section('content')



    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Issuers </h3>
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
                                        <th>Name</th>


                                        <th>Date Created</th>



                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $issuer)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $issuer->name }}</td>



                                            <td>{{ $issuer->created_at }}</td>




                                            <td>







                                                <a href="#"class="btn text-white fmdq_Blue" data-toggle="modal"
                                                    data-target="#deleteUser-{{ $issuer->id }}"><span>Delete</span></a>




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
    @foreach ($data as $key => $issuer)
        <div class="modal fade" id="deleteUser-{{ $issuer->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $issuer->name }}
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
                        <form method="POST" action="{{ route('deleteIssuer', $issuer->id) }}">
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





















    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Issuer</h5>
                    <br>
                    <form action="{{ route('addIssuer') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-gs">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">Upload PDF</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" name="pdfFile" class="custom-file-input" id="customFile"
                                                required accept="application/pdf">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
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




    <div class="modal fade" id="addBulk">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Bulk Security</h5>
                    <br>
                    <p>
                        <a href="{{ asset('upload_file/issuer_upload.csv') }}" download>
                            Click here to download the bulk Excel format
                        </a>
                    </p>




                    <br>
                    <br>
                    <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-gs">



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">Upload Bulk File</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" name="security_import_file" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
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
