@extends('layouts.admin')

@section('content')



  <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">IM Requirement Report</h3>
                                            <div class="nk-block-des text-soft">
                                               
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                              
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                 <div class="nk-block nk-block-lg">
                                  <div class="example-alert">
                                       


                                               

                                            
                                                                
                                    </div>
                                      
                                        <div class="card card-preview">
                                            <div class="card-inner">
                                         <table class="datatable-init nowrap table">
                                                    <thead>
                                                        <tr>
                                                        <th>S/N</th>
                                                        <th>Market Name</th>
                                                        <th>Category</th>
                                                        <th>Contract</th>
                                                        <th>Nominal Value</th>
                                                        <th>Net Position</th>
                                                        <th>Rate</th>
                                                        <th>MTM Price</th>
                                                        <th>Initial Margin</th>
                                                        <th>Date Created</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key => $im_result)
                                                        <tr>
                                                        <td> {{ $loop->iteration }}</td>
                                                        <td>{{ $im_result->marketName }}</td>
                                                        <td>{{ $im_result->catName }}</td>
                                                        <td>{{ $im_result->contractName }}</td>
                                                        <td><?php echo number_format($im_result->nominal_value, 2)?></td>
                                                        <td><?php echo number_format($im_result->net_position, 2)?></td>
                                                        <td><?php echo number_format($im_result->im_Rate, 2)?></td>
                                                        <td><?php echo number_format($im_result->price, 2)?></td>
                                                        <td><?php echo number_format($im_result->initial_margin, 2)?></td>

                                                        <td>{{ $im_result->created_at }}</td>
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































@endsection