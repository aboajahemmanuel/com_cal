 @extends('layouts.external')

 @section('content')

     <link href="{{ asset('assets/css/libs/fontawesome-icons.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/libs/themify-icons.css') }}" rel="stylesheet" type="text/css" />


     <div class="stricky-header stricked-menu main-menu">
         <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
     </div><!-- /.stricky-header -->
     <section class="page-header" style="height: 200px; ">
         <div class="page-header__bg" style="background-image: url({{ asset('asset/images/Est.jpg') }}); height: 200px;">
         </div>
         <!-- /.page-header__bg -->
         <div class="container" style="padding-top: 40px;">
             <h2>Initial Margin (Q-Calc)</h2>
             &nbsp;
             <ul class="thm-breadcrumb list-unstyled">
                 <li><span><a href="{{ url('/') }}">Home</a></span></li>
                 <li><span> <a href="{{ url('im_results', $ip) }}">Portfolio Builder</a></span></li>

                 <li><span> <a href="{{ url('im_report', $ip) }}">Initial Margin Requirement Report</a></span></li>

                 <li><span>Collateral Breakdown Report</span></li>



             </ul><!-- /.thm-breadcrumb list-unstyled -->
         </div><!-- /.container -->
     </section><!-- /.page-header -->

     <section class="loan-Calculator pt-50 pb-120">
         {{-- <section class="loan-Calculator pt-120 pb-120"> --}}
         <div class="container">
             <div class="loan-calculator__top">
                 {{-- <h2 class="">Initial Margin </h2> --}}
                 <h4>Summary</h4>

                 @php
                     $postdate = now(); // Get the current date and time using Carbon
                     $newDateFormat = $postdate->format('M. j, Y');
                 @endphp

                 <p><b>{{ $newDateFormat }}</b></p>

                 {{-- <a  href="#" data-toggle="modal" data-target="#addCustomer" class="thm-btn">
                       Add New Portfolio
                    </a> --}}
             </div><!-- loan_calculator_top -->


             <br>
             <div class="loan-comparison__body" id="compare-emi-1">

                 <div class="row">

                     <div class="col-md-12" style="border: 1px solid #1d326d; ">
                         <div class="compare-table table-responsive">
                             <div>
                                 <br>
                                 {{-- <h4>Summary</h4> --}}
                                 <br>
                                 <table class="table" style="min-width: 400px; max-width: 900px;">
                                     <h4>Portfolio Builder</h4>
                                     <thead>
                                         <tr>

                                             <th>
                                                 <center>Market</center>
                                             </th>
                                             <th>
                                                 <center>Product Category</center>
                                             </th>
                                             <th>
                                                 <center>Contract</center>
                                             </th>
                                             <th>
                                                 <center>Initial Margin Rate</center>
                                             </th>
                                             <th>
                                                 <center>Entry Price</center>
                                             </th>
                                             <th>
                                                 <center>Net Position (Long/Short)</center>
                                             </th>
                                             <th>
                                                 <center>Nominal Value ($ or ₦)</center>
                                             </th>
                                             <th>
                                                 <center>Initial Margin11 (₦)</center>
                                             </th>



                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($im_prt_builder as $imresult)
                                             <tr>
                                                 <td>{{ $imresult->marketName }}</td>
                                                 <td>{{ $imresult->catName }}</td>
                                                 <td>{{ $imresult->contractName }}</td>

                                                 <td>
                                                     <?php echo number_format($imresult->im_Rate, 2); ?>
                                                 </td>


                                                 <td>
                                                     <?php echo number_format($imresult->price, 2); ?>

                                                 </td>
                                                 <td>


                                                     <?php echo number_format($imresult->net_position, 2); ?>


                                                 </td>

                                                 <td>
                                                     @php

                                                         $category = \App\Models\Category::where('name', '=', $imresult->catName)->first();
                                                         $deno = \App\Models\Denomination::where('id', '=', $category->denomination_id)->first();

                                                     @endphp

                                                     @if ($deno->name == 'Dollar')
                                                         $<?php echo number_format($imresult->nominal_value, 2); ?>
                                                     @endif

                                                     @if ($deno->name == 'Naira')
                                                         ₦<?php echo number_format($imresult->nominal_value, 2); ?>
                                                     @endif
                                                 </td>

                                                 <td>
                                                     <?php echo number_format($imresult->initial_margin, 2); ?>

                                                 </td>

                                             </tr>
                                         @endforeach



                                     </tbody>
                                     <tfoot>
                                         <tr>
                                             <td><b>Total</b></td>
                                             <td @disabled(true)></td>
                                             <td><b></b></td>
                                             <td><b></b></td>
                                             <td><b></b></td>

                                             <td><b> <?php echo number_format($totalNetPosition, 2); ?></b></td>
                                             {{-- <td><b> <?php echo number_format($totalNV, 2); ?></b></td> --}}
                                             <td><b> </b></td>
                                             <td><b><?php echo number_format($totalNetIM_port_builder, 2); ?></b></td>
                                         </tr>

                                     </tfoot>
                                 </table>
                                 <table class="table" style="min-width: 535px; max-width: 540px;">

                                     <thead class="thead-dark">

                                         <tr>
                                             <th scope="col">Required Initial Margin Collateral</th>
                                             <th scope="col"><?php echo number_format($totalim_obligation, 2); ?></th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>Cash Component</td>
                                             <td><?php $cash_collateral = 0.25 * $totalim_obligation;
                                             echo number_format($cash_collateral, 2); ?></td>
                                         </tr>
                                         <tr>

                                             <td>Non-Cash Component</td>
                                             <td><?php $security_collateral = 0.75 * $totalim_obligation;
                                             echo number_format($security_collateral, 2); ?></td>

                                         </tr>

                                     </tbody>
                                     <br>

                                 </table>


                             </div>
                             <div style="display: flex; align-items: center; gap: 80px;">
                                 <div>
                                     <table class="table" style="max-width: 908px;">
                                         <h4>Cash Initial Margin Collateral Capture</h4>
                                         <thead>
                                             <tr>
                                                 <th>
                                                     <center>Denomination</center>
                                                 </th>
                                                 <th>
                                                     <center>Exchange Rate</center>
                                                 </th>
                                                 <th>
                                                     <center>Haircut Profile</center>
                                                 </th>
                                                 <th>
                                                     <center>Face Value</center>
                                                 </th>
                                                 <th>
                                                     <center>Market Value</center>
                                                 </th>

                                                 <th></th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($im_results as $imresult)
                                                 <tr>
                                                     <td>{{ $imresult->denomination }}</td>
                                                     <td><?php echo number_format($imresult->ex_rate, 2); ?>
                                                     </td>

                                                     <td>
                                                         <?php echo number_format($imresult->haircut_profile, 2); ?>
                                                     </td>
                                                     <td><?php echo number_format($imresult->facevalue, 2); ?>
                                                     </td>

                                                     <td>
                                                         <?php echo number_format($imresult->marketvalue, 2); ?>


                                                     </td>


                                                     <td>
                                                         <div class="d-flex">
                                                             <a href="#" class="btn text-white fmdq_Gold"
                                                                 data-toggle="modal"
                                                                 data-target="#edit-{{ $imresult->id }}">
                                                                 <span>Edit</span>
                                                             </a>
                                                             &nbsp;

                                                             <a href="#" class="btn text-white fmdq_Gold"
                                                                 data-toggle="modal"
                                                                 data-target="#deleteUser-{{ $imresult->id }}">
                                                                 <span>Delete</span>
                                                             </a>
                                                         </div>




                                                     </td>


                                                 </tr>
                                                 <div class="modal fade" id="edit-{{ $imresult->id }}">
                                                     <div class="modal-dialog modal-md" role="document">
                                                         <div class="modal-content">
                                                             <a href="#" class="close" data-dismiss="modal"
                                                                 aria-label="Close">
                                                                 <em class="icon ni ni-cross-sm"></em>
                                                             </a>
                                                             <div class="modal-body modal-body-md">
                                                                 <h5 class="modal-title">Edit Cash Initial Margin Collateral
                                                                 </h5>
                                                                 <form action="{{ route('update_cashim', $imresult->id) }}"
                                                                     method="post" class="mt-2">
                                                                     <div class="row g-gs">

                                                                         @csrf

                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Denomination <span
                                                                                     style="color: red;">*</span></label>


                                                                             <select required name="denomination"
                                                                                 id="country-dropdown2-{{ $imresult->id }}"
                                                                                 class="form-control country-dropdown2">

                                                                                 @foreach ($denominatios as $data)
                                                                                     <option value="{{ $data->id }}"
                                                                                         @if ($data->name == $imresult->denomination) selected @endif>
                                                                                         {{ $data->name }}
                                                                                     </option>
                                                                                 @endforeach


                                                                                 {{-- @foreach ($denominatios as $data)
                                                                                     <option value="{{ $data->id }}">
                                                                                         {{ $data->name }}
                                                                                     </option>
                                                                                 @endforeach --}}
                                                                             </select>
                                                                         </div>

                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Exchange Rate <span
                                                                                     style="color: red;">*</span></label>

                                                                             <select class="form-control" @readonly(true)
                                                                                 name="ex_rate"
                                                                                 id="state-dropdown2-{{ $imresult->id }}"
                                                                                 required>
                                                                                 <option value="{{ $imresult->ex_rate }}">
                                                                                     {{ $imresult->ex_rate }}
                                                                                 </option>

                                                                             </select>
                                                                         </div>





                                                                         <div class="col-md-12">
                                                                             <label class="form-label" for="inputEmail">Face
                                                                                 Value <span
                                                                                     style="color: red;">*</span></label>
                                                                             <input type="text" step="0.01"
                                                                                 value="{{ $imresult->facevalue }}"
                                                                                 name="facevalue"
                                                                                 class="form-control formattedNumberField"
                                                                                 id="inputEmail" placeholder="0" required>
                                                                         </div>

                                                                         <div class="col-12">
                                                                             <div class="pop-up-btns">
                                                                                 <br>
                                                                                 <button type="submit"
                                                                                     class="btn text-white fmdq_Gold">Submit</button>
                                                                                 <button data-dismiss="modal"
                                                                                     class="btn text-white fmdq_Blue"
                                                                                     style="font-size: 12px;"
                                                                                     aria-label="Close">
                                                                                     Close
                                                                                 </button>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </form>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>


                                                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                                 <script>
                                                     $(document).ready(function() {

                                                         $('#country-dropdown2-{{ $imresult->id }}').on('change', function() {
                                                             var idCountry = this.value;
                                                             $("#state-dropdow2").html('');
                                                             $.ajax({
                                                                 url: "{{ url('fetch-ex_rates') }}",
                                                                 type: "POST",
                                                                 data: {
                                                                     country_id: idCountry,
                                                                     _token: '{{ csrf_token() }}'
                                                                 },
                                                                 dataType: 'json',
                                                                 success: function(result) {
                                                                     $('#state-dropdown2-{{ $imresult->id }}').html('');
                                                                     $.each(result.rate, function(key, value) {
                                                                         $("#state-dropdown2-{{ $imresult->id }}").append(
                                                                             '<option value="' + value
                                                                             .rate + '">' + value.rate + '</option>');
                                                                     });
                                                                     $('#city-dropdown').html(
                                                                         '<option value="">-- Select Contract --</option>');
                                                                 }
                                                             });
                                                         });

                                                     });
                                                 </script>

                                                 <div class="modal fade" id="deleteUser-{{ $imresult->id }}"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                     <div class="modal-dialog">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title" id="staticBackdropLabel">
                                                                     {{ $imresult->name }}
                                                                 </h5>

                                                             </div>
                                                             <div class="modal-body modal-body-sm text-center">
                                                                 <div class="nk-modal py-4">
                                                                     <em
                                                                         class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                                                                     <h4 class="nk-modal-title">Are You Sure ?</h4>
                                                                     <div class="nk-modal-text mt-n2">
                                                                         <p class="text-soft">This Data will be delete
                                                                             permanently.
                                                                         </p>
                                                                     </div>

                                                                 </div>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <form method="POST"
                                                                     action="{{ route('delete_cashin', $imresult->id) }}">
                                                                     @csrf
                                                                     <button type="submit" id="deleteOrg"
                                                                         class="btn text-white fmdq_Gold">Yes, Delete
                                                                         it</button>
                                                                 </form>
                                                                 <button data-dismiss="modal" data-toggle="modal"
                                                                     data-target="#editEventPopup"
                                                                     class="btn text-white fmdq_Blue">Cancel</button>


                                                             </div>
                                                         </div>
                                                         <!-- /.modal-content -->
                                                     </div>
                                                     <!-- /.modal-dialog -->
                                                 </div>
                                             @endforeach



                                         </tbody>

                                         @if (count($im_results) > 0)
                                             <tfoot style="border: 0mm">
                                                 <tr>
                                                     <td><b></b></td>
                                                     <td> </td>
                                                     <td><b></b></td>
                                                     <td><b></b></td>


                                                     @if ($totalNetIM < $cash_collateral)
                                                         <td style="background-color: red; color: white"><b>
                                                                 <center>Check</center>
                                                             </b></td>
                                                     @endif


                                                     @if ($totalNetIM >= $cash_collateral)
                                                         <td style="background-color: green; color: white"><b>
                                                                 <center>Check</center>
                                                             </b></td>
                                                     @endif





                                                 </tr>




                                             </tfoot>

                                             <tfoot>
                                                 <tr>
                                                     <td><b>Total</b></td>
                                                     <td><b> </b></td>
                                                     <td><b></b></td>
                                                     <td><b><?php echo number_format($totalfacevalue, 2); ?></b></td>


                                                     <td><b><?php echo number_format($totalNetIM, 2); ?></b></td>
                                                 </tr>


                                             </tfoot>
                                         @endif
                                     </table>
                                 </div>


                                 <a href="#"data-toggle="modal" data-target="#addCustomer">
                                     <i class="fa-solid fa-square-plus"
                                         style="color: #CC9933; font-size: 34px; margin: 30px 0px 0px 0px; "></i></a>
                             </div>

                             <br>
                             <div style="display: flex; align-items: center; gap: 80px;">
                                 <div>
                                     <table class="table" style="max-width: 900px;">
                                         <h4>Non-Cash Initial Margin Collateral Capture</h4>
                                         <thead>
                                             <tr>
                                                 <th>
                                                     <center>Security Type</center>
                                                 </th>
                                                 <th>
                                                     <center>Security</center>
                                                 </th>
                                                 <th>
                                                     <center>Security Price</center>
                                                 </th>
                                                 <th>
                                                     <center>Haircut Profile</center>
                                                 </th>
                                                 <th>
                                                     <center>Face Value</center>
                                                 </th>
                                                 <th>
                                                     <center>Market Value</center>
                                                 </th>

                                                 <th></th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($n_im_results as $n_imresult)
                                                 <tr>
                                                     <td>{{ $n_imresult->securitytype }}</td>
                                                     <td>{{ $n_imresult->security }}</td>
                                                     <td>
                                                         <?php echo number_format($n_imresult->securityprice, 2); ?>
                                                     </td>
                                                     <td>
                                                         <?php echo number_format($n_imresult->haircut_profile, 2); ?>
                                                     </td>
                                                     <td><?php echo number_format($n_imresult->facevalue, 2); ?>
                                                     </td>






                                                     <td>
                                                         <?php echo number_format($n_imresult->marketvalue, 2); ?>

                                                     </td>

                                                     <td>
                                                         <div class="d-flex">
                                                             <a href="#" class="btn text-white fmdq_Gold"
                                                                 data-toggle="modal"
                                                                 data-target="#editncash-{{ $n_imresult->id }}">
                                                                 <span>Edit</span>
                                                             </a>
                                                             &nbsp;

                                                             <a href="#" class="btn text-white fmdq_Gold"
                                                                 data-toggle="modal"
                                                                 data-target="#deleteUser-{{ $n_imresult->id }}">
                                                                 <span>Delete</span>
                                                             </a>
                                                         </div>
                                                     </td>

                                                 </tr>
                                                 <div class="modal fade" id="editncash-{{ $n_imresult->id }}">
                                                     <div class="modal-dialog modal-md" role="document">
                                                         <div class="modal-content">
                                                             <a href="#" class="close" data-dismiss="modal"
                                                                 aria-label="Close">
                                                                 <em class="icon ni ni-cross-sm"></em>
                                                             </a>
                                                             <div class="modal-body modal-body-md">
                                                                 <h5 class="modal-title">Edit Non Cash Initial Margin
                                                                     Collateral</h5>
                                                                 <form
                                                                     action="{{ route('update_n_cash', $n_imresult->id) }}"
                                                                     method="post" class="mt-2">
                                                                     <div class="row g-gs">

                                                                         @csrf

                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Security Type <span
                                                                                     style="color: red;">*</span></label>


                                                                             <select required name="security_type"
                                                                                 id="security_type-dropdown2-{{ $n_imresult->id }}"
                                                                                 class="form-control">
                                                                                 {{-- <option value="">-- Select--
                                                                                 </option> --}}
                                                                                 @foreach ($security_type as $securitytype)
                                                                                     <option
                                                                                         value="{{ $securitytype->id }}"
                                                                                         @if ($securitytype->name == $n_imresult->securitytype) selected @endif>
                                                                                         {{ $securitytype->name }}
                                                                                     </option>
                                                                                 @endforeach

                                                                                 {{-- @foreach ($security_type as $securitytype)
                                                                                     <option
                                                                                         value="{{ $securitytype->id }}">
                                                                                         {{ $securitytype->name }}
                                                                                     </option>
                                                                                 @endforeach --}}
                                                                             </select>
                                                                         </div>

                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Security <span
                                                                                     style="color: red;">*</span></label>

                                                                             <select class="form-control" name="security"
                                                                                 id="security-dropdown2-{{ $n_imresult->id }}"
                                                                                 required>

                                                                                 <option
                                                                                     value="{{ $n_imresult->security }}">
                                                                                     {{ $n_imresult->security }}
                                                                                 </option>
                                                                             </select>
                                                                         </div>



                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Security Price <span
                                                                                     style="color: red;">*</span></label>

                                                                             <select class="form-control" @readonly(true)
                                                                                 name="securityprice"
                                                                                 id="price-dropdown2-{{ $n_imresult->id }}"
                                                                                 required>

                                                                                 <option
                                                                                     value="{{ $n_imresult->securityprice }}">
                                                                                     {{ $n_imresult->securityprice }}
                                                                                 </option>

                                                                             </select>
                                                                         </div>





                                                                         <div class="col-md-12">
                                                                             <label class="form-label"
                                                                                 for="inputEmail">Face Value <span
                                                                                     style="color: red;">*</span></label>
                                                                             <input type="text" step="0.01"
                                                                                 name="facevalue"
                                                                                 value="{{ $n_imresult->facevalue }}"
                                                                                 class="form-control formattedNumberField"
                                                                                 id="inputEmail" placeholder="0" required>
                                                                         </div>


                                                                         <input hidden name="security_id"
                                                                             value="{{ $n_imresult->security_id }}">

                                                                         <div class="col-md-12">

                                                                             <label class="form-label"
                                                                                 for="inputEmail">Denomination <span
                                                                                     style="color: red;">*</span></label>

                                                                             <select required name="denomination"
                                                                                 class="form-control"
                                                                                 id="currency-dropdown2">
                                                                                 {{-- <option value="">-- Select--
                                                                                 </option> --}}

                                                                                 <option
                                                                                     value="{{ $n_imresult->denomination }}">
                                                                                     {{ $n_imresult->denomination }}
                                                                                 </option>

                                                                                 {{-- @foreach ($denominatios as $data)
                                                                                     <option value="{{ $data->id }}"
                                                                                         @if ($data->name == $n_imresult->denomination) selected @endif>
                                                                                         {{ $data->name }}
                                                                                     </option>
                                                                                 @endforeach --}}

                                                                             </select>
                                                                         </div>


                                                                         <div class="col-12">
                                                                             <div class="pop-up-btns">
                                                                                 <br>
                                                                                 <button type="submit"
                                                                                     class="btn text-white fmdq_Gold">Submit</button>
                                                                                 <button data-dismiss="modal"
                                                                                     class="btn text-white fmdq_Blue"
                                                                                     style="font-size: 12px;"
                                                                                     aria-label="Close">
                                                                                     Close
                                                                                 </button>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </form>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>


                                                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                 <script>
                                                     $('#security_type-dropdown2-{{ $n_imresult->id }}').on('change', function() {
                                                         var idSecurity = this.value;

                                                         // Clear the price dropdown when security type changes
                                                         $('#price-dropdown2-{{ $n_imresult->id }}').html('');

                                                         // Fetch securities based on the selected security type
                                                         $.ajax({
                                                             url: "{{ url('fetch-securities') }}",
                                                             type: "POST",
                                                             data: {
                                                                 security_id: idSecurity,
                                                                 _token: '{{ csrf_token() }}'
                                                             },
                                                             dataType: 'json',
                                                             success: function(result_sec) {
                                                                 $('#security-dropdown2-{{ $n_imresult->id }}').html(
                                                                     '<option value="">-- Select Security --</option>');
                                                                 $.each(result_sec.securities, function(key, value) {
                                                                     $("#security-dropdown2-{{ $n_imresult->id }}").append(
                                                                         '<option value="' + value.id + '">' + value.name + '</option>');
                                                                 });
                                                             }
                                                         });
                                                     });

                                                     $('#security_type-dropdown2-{{ $n_imresult->id }}').on('change', function() {
                                                         var idCurrency = this.value;

                                                         // Clear the currency dropdown when security type changes
                                                         $("#currency-dropdown2").html('');

                                                         // Fetch currencies based on the selected security type
                                                         $.ajax({
                                                             url: "{{ url('fetch-security-currency') }}",
                                                             type: "POST",
                                                             data: {
                                                                 currency_id: idCurrency,
                                                                 _token: '{{ csrf_token() }}'
                                                             },
                                                             dataType: 'json',
                                                             success: function(result_currency) {
                                                                 $('#currency-dropdown2').html('');
                                                                 $.each(result_currency.currency, function(key, value) {
                                                                     $("#currency-dropdown2").append('<option value="' + value.id + '">' +
                                                                         value.name + '</option>');
                                                                 });
                                                             }
                                                         });
                                                     });

                                                     $('#security-dropdown2-{{ $n_imresult->id }}').on('change', function() {
                                                         var idSec = this.value;

                                                         // Clear the price dropdown when security changes
                                                         $("#price-dropdown2-{{ $n_imresult->id }}").html('');

                                                         // Fetch security prices based on the selected security
                                                         $.ajax({
                                                             url: "{{ url('fetch-security-price') }}",
                                                             type: "POST",
                                                             data: {
                                                                 sec_id: idSec,
                                                                 _token: '{{ csrf_token() }}'
                                                             },
                                                             dataType: 'json',
                                                             success: function(res_sec) {
                                                                 $('#price-dropdown2-{{ $n_imresult->id }}').html('');
                                                                 $.each(res_sec.security_price, function(key, value) {
                                                                     $("#price-dropdown2-{{ $n_imresult->id }}").append('<option value="' +
                                                                         value.securityprice + '">' + value.securityprice + '</option>');
                                                                 });
                                                             }
                                                         });
                                                     });
                                                 </script>



                                                 <div class="modal fade" id="deleteUser-{{ $n_imresult->id }}"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                     <div class="modal-dialog">
                                                         <div class="modal-content">
                                                             <div class="modal-header">
                                                                 <h5 class="modal-title" id="staticBackdropLabel">
                                                                     {{ $n_imresult->name }}
                                                                 </h5>

                                                             </div>
                                                             <div class="modal-body modal-body-sm text-center">
                                                                 <div class="nk-modal py-4">
                                                                     <em
                                                                         class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                                                                     <h4 class="nk-modal-title">Are You Sure ?</h4>
                                                                     <div class="nk-modal-text mt-n2">
                                                                         <p class="text-soft">This Data will be delete
                                                                             permanently.
                                                                         </p>
                                                                     </div>

                                                                 </div>
                                                             </div>
                                                             <div class="modal-footer">
                                                                 <form method="POST"
                                                                     action="{{ route('delete_n_cash', $n_imresult->id) }}">
                                                                     @csrf
                                                                     <button type="submit" id="deleteOrg"
                                                                         class="btn text-white fmdq_Gold">Yes, Delete
                                                                         it</button>
                                                                 </form>
                                                                 <button data-dismiss="modal" data-toggle="modal"
                                                                     data-target="#editEventPopup"
                                                                     class="btn text-white fmdq_Blue">Cancel</button>


                                                             </div>
                                                         </div>
                                                         <!-- /.modal-content -->
                                                     </div>
                                                     <!-- /.modal-dialog -->
                                                 </div>
                                             @endforeach



                                         </tbody>
                                         @if (count($n_im_results) > 0)
                                             <tfoot>
                                                 <tr>
                                                     <td><b></b></td>
                                                     <td><b></b></td>
                                                     <td><b></b></td>
                                                     <td><b></b></td>

                                                     <td><b> </b></td>
                                                     @if ($totalMV < $security_collateral)
                                                         <td style="background-color: red; color: white"><b>
                                                                 <center>Check</center>
                                                             </b></td>
                                                     @endif


                                                     @if ($totalMV >= $security_collateral)
                                                         <td style="background-color: green; color: white"><b>
                                                                 <center>Check</center>
                                                             </b></td>
                                                     @endif
                                                 </tr>


                                             </tfoot>



                                             <tfoot>
                                                 <tr>
                                                     <td><b>Total</b></td>
                                                     <td><b></b></td>
                                                     <td><b>
                                                         </b></td>
                                                     <td><b></b></td>

                                                     <td><b><?php echo number_format($totalNCFACE, 2); ?> </b></td>
                                                     <td><b><?php echo number_format($totalMV, 2); ?></b></td>
                                                 </tr>

                                             </tfoot>
                                         @endif
                                     </table>
                                 </div>
                                 <a href="#"data-toggle="modal" data-target="#ncash"> <i
                                         class="fa-solid fa-square-plus"
                                         style="color: #CC9933; font-size: 34px; margin: 30px 0px 0px 0px"></i></a>

                             </div>


                         </div><!-- compare-table -->
                         <div class="lowest-emi-note" style="padding-bottom: 10px">
                             <a href="{{ url('im_results', $ip) }}">
                                 <button class="thm-btn">
                                     Portfolio Builder
                                 </button>
                             </a>
                             &nbsp; &nbsp;

                             @if (count($n_im_results) > 0 || count($im_results) > 0)
                                 <a href="{{ url('/generate-pdf', $ip) }}" class="thm-btn">


                                     <span class="btn-text"> Download Report</span>

                                     {{-- <button class="thm-btn">
                      
                      </button> --}}
                                 </a>
                             @endif





                         </div>
                     </div><!-- col-md-12 -->

                 </div>
             </div><!-- loan-comparison__body -->


             {{-- <a href="{{ url('/generate-pdf',$ip ) }}" class="btn btn-primary">Export as PDF</a> --}}

             <a name="success-message"></a>


         </div> <!-- container -->
     </section> <!-- calculator -->



     <div class="modal fade" id="addCustomer">
         <div class="modal-dialog modal-md" role="document">
             <div class="modal-content">
                 <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                     <em class="icon ni ni-cross-sm"></em>
                 </a>
                 <div class="modal-body modal-body-md">
                     <h5 class="modal-title">Cash Initial Margin Collateral</h5>
                     <form action="{{ route('add_cashim') }}" method="post" class="mt-2">
                         <div class="row g-gs">

                             @csrf

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Denomination <span
                                         style="color: red;">*</span></label>


                                 <select required name="denomination" id="country-dropdown" class="form-control">
                                     <option value="">-- Select--</option>
                                     @foreach ($denominatios as $data)
                                         <option value="{{ $data->id }}">
                                             {{ $data->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Exchange Rate <span
                                         style="color: red;">*</span></label>

                                 <select class="form-control" @readonly(true) name="ex_rate" id="state-dropdown"
                                     required>


                                 </select>
                             </div>





                             <div class="col-md-12">
                                 <label class="form-label" for="inputEmail">Face Value <span
                                         style="color: red;">*</span></label>
                                 <input type="text" step="0.01" name="facevalue"
                                     class="form-control formattedNumberField" id="inputEmail" placeholder="0" required>
                             </div>






                             <div class="col-12">
                                 <div class="pop-up-btns">
                                     <br>
                                     <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
                                     <button data-dismiss="modal" class="btn text-white fmdq_Blue"
                                         style="font-size: 12px;" aria-label="Close">
                                         Close
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>




     <div class="modal fade" id="ncash">
         <div class="modal-dialog modal-md" role="document">
             <div class="modal-content">
                 <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                     <em class="icon ni ni-cross-sm"></em>
                 </a>
                 <div class="modal-body modal-body-md">
                     <h5 class="modal-title">Non Cash Initial Margin Collateral</h5>
                     <form action="{{ route('add_n_cashim') }}" method="post" class="mt-2">
                         <div class="row g-gs">

                             @csrf

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Security Type <span
                                         style="color: red;">*</span></label>


                                 <select required name="security_type" id="security_type-dropdown" class="form-control">
                                     <option value="">-- Select--</option>
                                     @foreach ($security_type as $securitytype)
                                         <option value="{{ $securitytype->id }}">
                                             {{ $securitytype->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Security <span
                                         style="color: red;">*</span></label>

                                 <select class="form-control" name="security" id="security-dropdown" required>


                                 </select>
                             </div>



                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Security Price <span
                                         style="color: red;">*</span></label>

                                 <select class="form-control" @readonly(true) name="securityprice" id="price-dropdown"
                                     required>


                                 </select>
                             </div>





                             <div class="col-md-12">
                                 <label class="form-label" for="inputEmail">Face Value <span
                                         style="color: red;">*</span></label>
                                 <input type="text" step="0.01" name="facevalue"
                                     class="form-control formattedNumberField" id="inputEmail" placeholder="0" required>
                             </div>



                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Denomination <span
                                         style="color: red;">*</span></label>

                                 <select class="form-control" @readonly(true) name="denomination"
                                     id="currency-dropdown" required>


                                 </select>
                             </div>




                             {{-- <select required name="denomination" id="country-dropdown" class="form-control">
                                     <option value="">-- Select--</option>
                                     @foreach ($denominatios as $data)
                                         <option value="{{ $data->id }}">
                                             {{ $data->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div> --}}


                             <div class="col-12">
                                 <div class="pop-up-btns">
                                     <br>
                                     <button type="submit" class="btn text-white fmdq_Gold">Submit</button>
                                     <button data-dismiss="modal" class="btn text-white fmdq_Blue"
                                         style="font-size: 12px;" aria-label="Close">
                                         Close
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>



     @if (Session::has('success'))
         <div class="modal fade" id="modalAlert" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">

                     <div class="modal-body modal-body-sm text-center">
                         <div class="nk-modal py-4">
                             <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                             <h4 class="nk-modal-title"> {{ \Session::get('success') }}</h4>
                         </div>
                     </div>
                     <button data-dismiss="modal" data-toggle="modal" data-target="#editEventPopup"
                         class="btn text-white fmdq_Blue">Close</button>

                     <!-- /.modal-content -->
                 </div>
                 <!-- /.modal-dialog -->
             </div>


             @php
                 Session::forget('success');
             @endphp
     @endif


     <script>
         window.onload = function() {
             // First modal
             let myModal = new bootstrap.Modal(
                 document.getElementById("modalAlert"), {}
             );
             myModal.show();

             // Second modal
             let myModalcreate = new bootstrap.Modal(
                 document.getElementById("modalAlertCreate"), {}
             );
             myModalcreate.show();
         };
     </script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
         $(document).ready(function() {

             /*------------------------------------------
             --------------------------------------------
             Country Dropdown Change Event
             --------------------------------------------
             --------------------------------------------*/
             $('#country-dropdown').on('change', function() {
                 var idCountry = this.value;
                 $("#state-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-ex_rates') }}",
                     type: "POST",
                     data: {
                         country_id: idCountry,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result) {
                         $('#state-dropdown').html('');
                         $.each(result.rate, function(key, value) {
                             $("#state-dropdown").append('<option value="' + value
                                 .rate + '">' + value.rate + '</option>');
                         });
                         $('#city-dropdown').html(
                             '<option value="">-- Select Contract --</option>');
                     }
                 });
             });










             $('#security_type-dropdown').on('change', function() {
                 var idCurrency = this.value;
                 $("#currency-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-security-currency') }}",
                     type: "POST",
                     data: {
                         currency_id: idCurrency,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result_currency) {
                         $('#currency-dropdown').html(
                             '');
                         $.each(result_currency.currency, function(key, value) {
                             $("#currency-dropdown").append('<option value="' + value
                                 .id + '">' + value.name + '</option>');
                         });
                     }

                 });
             });




             $('#security_type-dropdown').on('change', function() {
                 var idSecurity = this.value;
                 $("#security-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-securities') }}",
                     type: "POST",
                     data: {
                         security_id: idSecurity,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result_sec) {
                         $('#security-dropdown').html(
                             '<option value="">-- Select Security --</option>');
                         $.each(result_sec.securities, function(key, value) {
                             $("#security-dropdown").append('<option value="' + value
                                 .id + '">' + value.name + '</option>');
                         });
                     }
                 });
             });




             /*------------------------------------------
             --------------------------------------------
             State Dropdown Change Event
             --------------------------------------------
             --------------------------------------------*/
             $('#security-dropdown').on('change', function() {
                 var idSec = this.value;
                 $("#price-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-security-price') }}",
                     type: "POST",
                     data: {
                         sec_id: idSec,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(res_sec) {
                         $('#price-dropdown').html('');
                         $.each(res_sec.security_price, function(key, value) {
                             $("#price-dropdown").append('<option value="' + value
                                 .securityprice + '">' + value.securityprice +
                                 '</option>');
                         });
                     }
                 });
             });







         });
     </script>




 @endsection
