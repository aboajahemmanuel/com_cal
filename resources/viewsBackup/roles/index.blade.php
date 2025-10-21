
@extends('layouts.admin')

@section('content')



                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Roles</h3>
                                            <div class="nk-block-des text-soft">
                                               
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="more-options">
                                                    <ul class="nk-block-tools g-3">
                                                   
                                                       
                                                        <li class="nk-block-tools-opt">
                                                            <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                            <a href="#" data-toggle="modal" data-target="#addUser" class="btn text-white fmdq_Gold"><em class="icon ni ni-plus"></em><span>Add</span></a>
                                                        </li>

                                                        {{-- <li><a href="#" data-toggle="modal" data-target="#addLead"><span>Add Orgranigation</span></a></li>
                                                        <li><a href="#"><span>Import Lead</span></a></li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block nk-block-lg">
                                   
                                        <div class="example-alert">
                                            @if (\Session::has('success'))
                                     <div class="alert alert-success alert-icon alert-dismissible">
                                        <em class="icon ni ni-check-circle"></em>  <strong> {{ \Session::get('success') }}<button class="close" data-dismiss="alert"></button>
                                            </div>
                                            @endif


                                            @if (count($errors) > 0)
                                            <div><div class="alert alert-danger alert-icon alert-dismissible">
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
                                          
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th>#</th>
                                                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></th>
                                                        
                                                        <th class="nk-tb-col nk-tb-col-tools text-right">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $role)
                                                    <tr class="nk-tb-item">
                                                        <td class="nk-tb-col nk-tb-col-check">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td class="nk-tb-col">
                                                            <div class="user-card">
                                                              
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{$role->name}} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                                  
                                                                </div>
                                                            </div>
                                                        </td>
                                                     
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span>{{$role->created_at}}</span>
                                                        </td>
                                                       
                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                              
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"  href="#" data-toggle="modal" data-target="#editGroup-{{$role->id}}"
                                                             
                                                          ><em class="icon ni ni-edit"></em><span>Edit</span></a></li>

                                                          <li><a href="#"  href="#" data-toggle="modal" data-target="#deleteGroup-{{$role->id}}"
                                                             
                                                            ><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                              
                                                          
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr><!-- .nk-tb-item  -->
                                                    @endforeach
                                                 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
  <!-- @@ Group Add Modal @e -->
  <div class="modal fade" role="dialog" id="addUser">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title">Add Group</h5>
                <form  method="POST" action="{{ route('roles.store')}}" >
                    @csrf
                <div class="tab-content">
                    <div class="tab-pane active" id="infomation">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="lead-name">Role Name</label>
                                    <div class="form-control-wrap">
                                        <input name="name" type="text" class="form-control" id="lead-name" placeholder="e.g. Abu Bin Ishtiyak">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="lead-name">Permission</label>
                                    <div class="form-control-wrap">
                                        @foreach($permission as $value)
                                      {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                        {{ $value->name }}</label>
                                    <br/>
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                         


                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit"  class="btn text-white fmdq_Gold">Submit</button>
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




@foreach ($data as $key => $role)
<div class="modal fade" role="dialog" id="editGroup-{{$role->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title">Edit Role</h5>
                    {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'PATCH']) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="infomation">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="lead-name">Role Name</label>
                                    <div class="form-control-wrap">
                                        <input  value="{{$role->name}}" name="name" type="text" class="form-control" id="lead-name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="lead-name">Permission</label>
                                    <div class="form-control-wrap">
                                        <?php
                                        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
                                       ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                       ->all();
                                       ?>


                                   @foreach($permission as $value)
                                   <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                   {{ $value->name }}</label>
                               <br/>
                               @endforeach
                                    </div>
                                </div>
                            </div>


                           
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit"  class="btn text-white fmdq_Gold">Update</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .tab-pane -->
                   
                </div><!-- .tab-content -->
             {!! Form::close() !!}
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->
@endforeach





<!-- @@  Delete Modal @e -->
@foreach ($data as $key => $role)
<div class="modal fade" id="deleteGroup-{{$role->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross"></em></a>
            <div class="modal-body modal-body-sm text-center">
                <div class="nk-modal py-4">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                    <h4 class="nk-modal-title">Are You Sure ?</h4>
                    <div class="nk-modal-text mt-n2">
                        <p class="text-soft">This Lead data will be delete permanently.</p>
                    </div>
                    <ul class="d-flex justify-content-center gx-4 mt-4">
                        <li>
                            <form  method="POST" action="{{ route('deleteRole', $role->id)}}" >
                                @csrf
                                <button type="submit" id="deleteOrg" class="btn text-white fmdq_Gold">Yes, Delete it</button>
                            </form>

                        
                        </li>
                        <li>
                            <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup" class="btn text-white fmdq_Blue">Cancel</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach<!-- .modal -->



@endsection