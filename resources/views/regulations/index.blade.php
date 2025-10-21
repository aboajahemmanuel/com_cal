@extends('layouts.admin')

@section('content')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Documents</h6>
                        {{-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="#">Tables</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data tables</li>
                        </ol> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" aria-expanded="true">
                                    <i class="fas fa-plus-circle"></i> Add New
                                </button>


                                {{-- <a href="{{url('regulations/create')}}" class="btn btn-primary  dropdown-toggle" type="button">
                                    <i class="fas fa-plus-circle"></i> Add New1
                                </a> --}}
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->



          
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (\Session::has('success'))
                           
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>{{ \Session::get('success') }}</strong>
                                </div>
                                
                            
                        @endif

                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>
                               @endif

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $regulation)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $regulation->title }}</td>
                                            <td>{{optional($regulation->category)->name}}</td>
                                            <td>
                                                @if($regulation->status == 0)
                                                <span class="badge bg-primary">Pending</span></td>
                                                @endif
                                                @if($regulation->status == 1)
                                                <span class="badge bg-success">Approved</span></td>
                                                @endif
                                                @if($regulation->status == 2)
                                                <span class="badge bg-danger">Rejected</span></td>
                                                @endif
                                                
                                            
                                            <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#deletecategory-{{$regulation->id}}">View</a>
                                               
                                                @can('regulation-edit')
                                                    <a class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editcategory-{{$regulation->id}}">Edit</a>
                                                @endcan
                                                
                                                @can('regulation-delete')
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletecategory-{{$regulation->id}}">Delete</a>
                                                @endcan

                                              
                                               
                                               
                                                @if($regulation->status == 0 )
                                                @can('regulation-approve')
                                               
                                                
                                                <button class="btn btn-success" name="SUBMIT" id="submit" onclick="document.getElementById('test1-{{$regulation->id}}').submit();" type="submit">
                                                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                                    Approve</button>
                                               

                                                    <form id="test1-{{$regulation->id}}" action="{{ route('RegStatus', $regulation->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        <input name="status" value="1">
                                                    </form>
                                                @endcan

                                                @can('regulation-reject')
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletecategory-{{$regulation->id}}">Reject</a>

                                                <form id="test1-{{$regulation->id}}" action="{{ route('RegStatus', $regulation->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    <input name="status" value="2">
                                                </form>
                                                @endcan

                                                @endif

                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

  


</div>

<!-- ADD MODAL -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Select Category
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <label for="validationCustom04" class="form-label">Category</label>
                <form>
                <select class="form-select" name="selected_value" id="selected_value" onchange="submitForm()">
                    <option selected disabled value="">Choose...</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </form>
               
            </div>
              
              <script>
                function submitForm() {
                  let selectedValue = document.getElementById('selected_value').value;
              
                  if (selectedValue) {
                    window.location.href = '{{url('')}}/regulations/create/' + selectedValue;
                  }
                }
              </script>
            <br>
            
        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="submit"
                class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
        </div> --}}
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>





<!-- EDIT MODAL -->
@foreach ($data as $key => $regulation)
<div class="modal fade" id="editcategory-{{ $regulation->id}}"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">{{ $regulation->name}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::model($regulation, ['route' => ['entities.update', $regulation->id],'method' => 'PATCH']) !!}
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="submit"
                class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
@endforeach


@foreach ($data as $key => $regulation)
<div class="modal fade" id="deletecategory-{{ $regulation->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">{{$regulation->title}}
        </h5>
 <button type="button" class="btn-close" data-bs-dismiss="modal"
 aria-label="Close"></button>
          </div>
    <div class="modal-body">
        <form  action="{{ route('RegStatus', $regulation->id) }}" method="POST" >
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label>Note</label>
                    <input hidden name="status" value="2">
                    <textarea required class="form-control" name="note"></textarea>
                </div>

            </div>
       
                                                               
            </div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
   </div>                                                 
    </div>                                           
  </div>
 </div>
@endforeach




{{-- @foreach ($data as $key => $regulation)
<div class="modal fade" id="deletecategory-{{ $regulation->id}}"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{ $regulation->name}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="col-md-12">
                
            <input type="text" class="form-select">
            
             
          </div>
        <div class="modal-footer">
            <form  method="POST" action="{{ route('deleteRegulations', $regulation->id)}}" >
                @csrf
                <button type="submit" id="deleteOrg" class="btn btn-success">Yes, Delete it</button>
            </form>
            <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup" class="btn btn-danger btn-dim">Cancel</button>
           
                
        </div>
    </div>
    <!-- /.modal-content -->
</div>

</div>
@endforeach --}}



<script>
    document.getElementById("selectOption").addEventListener("change", function() {
  let selectedOption = this.value;
  let options = ["rules-regulations", "guidelines", "market-notices", "market-bulletins", "market-circulars"];
  
  options.forEach(function(option) {
    if (option === selectedOption) {
      document.getElementById(option).style.display = "block";
    } else {
      document.getElementById(option).style.display = "none";
    }
  });
});
</script>


<script>
    function loading() {
  
  $(".btn .fa-spinner").show();
  $(".btn .btn-text").html("");
  
  }
  </script>
  

@endsection