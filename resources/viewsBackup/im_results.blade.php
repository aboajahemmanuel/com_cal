 @extends('layouts.external')

 @section('content')
     {{-- <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css')}}"> --}}
     <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                 {{-- <li><span>Portfolio Builder</span></li> --}}
                 <b>
                     <li><span>Initial Margin Requirement Report</span></li>
                 </b>
             </ul><!-- /.thm-breadcrumb list-unstyled -->
         </div><!-- /.container -->
     </section><!-- /.page-header -->
     <section class="loan-Calculator pt-50 pb-120">
         <div class="container">
             <div class="loan-calculator__top">
                 <h2 class="">Initial Margin - Portfolio Builder</h2>
                 <div>
                     <br>
                     <a href="#" data-toggle="modal" data-target="#addCustomer" class="thm-btn">
                         Add New Portfolio
                     </a>
                 </div>


             </div><!-- loan_calculator_top -->


             <div class="loan-comparison__body" id="compare-emi-1">

                 <div class="row">

                     <div class="col-md-12">
                         <div class="compare-table table-responsive">
                             <table class="table">
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
                                             <center>Initial Margin Rate (%)</center>
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
                                             <center>Initial Margin (₦)</center>
                                         </th>
                                         <th>
                                             <center>Action</center>
                                         </th>

                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($im_results as $imresult)
                                         <tr>
                                             <td>{{ $imresult->marketName }}</td>
                                             <td>{{ $imresult->catName }}</td>
                                             <td>{{ $imresult->contractName }}</td>

                                             <td>
                                                 {{ $imresult->im_Rate }}
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
                                             <td>
                                                 <div class="d-flex">
                                                     <a href="#" class="btn text-white fmdq_Gold" data-toggle="modal"
                                                         data-target="#edit-{{ $imresult->id }}">
                                                         <span>Edit</span>
                                                     </a>
                                                     &nbsp;

                                                     <a href="#" class="btn text-white fmdq_Gold" data-toggle="modal"
                                                         data-target="#deleteUser-{{ $imresult->id }}">
                                                         <span>Delete</span>
                                                     </a>
                                                 </div>




                                             </td>
                                         </tr>
                                         {{-- Edit --}}
                                         <div class="modal fade" id="edit-{{ $imresult->id }}">
                                             <div class="modal-dialog modal-md" role="document">
                                                 <div class="modal-content">
                                                     <a href="#" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <em class="icon ni ni-cross-sm"></em>
                                                     </a>
                                                     <div class="modal-body modal-body-md">
                                                         <h5 class="modal-title">Edit Portfolio</h5>
                                                         <form action="{{ route('im_update', $imresult) }}" method="post"
                                                             class="mt-2">
                                                             <div class="row g-gs">

                                                                 @csrf

                                                                 <div class="col-md-12">

                                                                     <label class="form-label" for="inputEmail">Market <span
                                                                             style="color: red;">*</span></label>


                                                                     <select required name="market"
                                                                         id="country-dropdown2-{{ $imresult->id }}"
                                                                         class="form-control country-dropdown2">
                                                                         <option value="">-- Select Market --</option>



                                                                         @foreach ($countries as $market)
                                                                             <option value="{{ $market->id }}"
                                                                                 @if ($market->name == $imresult->marketName) selected @endif>
                                                                                 {{ $market->name }}
                                                                             </option>
                                                                         @endforeach

                                                                     </select>
                                                                 </div>


                                                                 <div class="col-md-12">

                                                                     <label class="form-label" for="inputEmail">Product
                                                                         Category <span style="color: red;">*</span></label>

                                                                     <select class="form-control" name="category"
                                                                         id="state-dropdown2-{{ $imresult->id }}" required>
                                                                         @php $category =  \App\Models\Category::where('name','=',$imresult->catName)->first(); @endphp
                                                                         <option value="{{ $category->id }}">
                                                                             {{ $category->name }}
                                                                         </option>

                                                                     </select>
                                                                 </div>


                                                                 <div class="col-md-12">
                                                                     <label class="form-label" for="inputEmail">Contract
                                                                         <span style="color: red;">*</span></label>
                                                                     <select class="form-control" name="contract"
                                                                         id="city-dropdown2-{{ $imresult->id }}" required>
                                                                         @php $contract =  \App\Models\Contract::where('name','=',$imresult->contractName)->first(); @endphp
                                                                         <option value="{{ $contract->id }}">
                                                                             {{ $imresult->contractName }}
                                                                         </option>
                                                                     </select>
                                                                 </div>






                                                                 <div class="col-md-12">
                                                                     <label style="font-weight:;">Initial Margin Rate <span
                                                                             style="color: red;">*</span></label>
                                                                     <select class="form-control" name=""
                                                                         id="rate-dropdown2-{{ $imresult->id }}" required>
                                                                         @php $contract1 =  \App\Models\Contract::where('name','=',$imresult->contractName)->first(); @endphp
                                                                         <option value="{{ $contract1->im_Rate }}">
                                                                             {{ $contract1->im_Rate }}
                                                                         </option>
                                                                     </select>
                                                                 </div>


                                                                 <div class="col-md-12">
                                                                     <label style="font-weight:;">Nominal Value <span
                                                                             style="color: red;">*</span></label>
                                                                     <select disabled class="form-control" name=""
                                                                         id="nominal_value-dropdown2-{{ $imresult->id }}"
                                                                         required>
                                                                         @php $contract2 =  \App\Models\Contract::where('name','=',$imresult->contractName)->first(); @endphp
                                                                         <option value="{{ $contract2->nominal_value }}">
                                                                             {{ $contract2->nominal_value }}
                                                                     </select>

                                                                 </div>





                                                                 <div class="col-md-12">
                                                                     <label class="form-label" for="inputEmail">Net Position
                                                                         (Long/Short)
                                                                         <span style="color: red;">*</span></label>
                                                                     <input type="text"
                                                                         value="{{ $imresult->net_position }}"
                                                                         name="net_position"
                                                                         class="form-control formattedNumberField"
                                                                         id="inputEmail-{{ $imresult->id }}"
                                                                         placeholder="0" required>
                                                                 </div>

                                                                 <div class="col-md-12">
                                                                     <label class="form-label" for="inputEmail">MTM Price
                                                                         <span style="color: red;">*</span></label>
                                                                     <input type="text" step="0.01" name="price"
                                                                         value="{{ $imresult->price }}"
                                                                         class="form-control formattedNumberField"
                                                                         id="inputEmail-{{ $imresult->id }}"
                                                                         placeholder="0" required>
                                                                 </div>







                                                                 <div class="col-12">
                                                                     <div class="pop-up-btns">
                                                                         <br>
                                                                         <button type="submit"
                                                                             class="btn text-white fmdq_Gold">Submit</button>
                                                                         <button data-dismiss="modal"
                                                                             class="btn text-white fmdq_Blue"
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
                                         <script>
                                             $(document).ready(function() {

                                                 /*------------------------------------------
                                                 --------------------------------------------
                                                 Country Dropdown Change Event
                                                 --------------------------------------------
                                                 --------------------------------------------*/

                                                 $('#country-dropdown2-{{ $imresult->id }}').on('change', function() {
                                                     var idCountry = this.value;

                                                     $('#rate-dropdown2-{{ $imresult->id }}').html('');
                                                     $('#nominal_value-dropdown2-{{ $imresult->id }}').html('');
                                                     $("#state-dropdown-{{ $imresult->id }}").html('');
                                                     $.ajax({
                                                         url: "{{ url('fetch-states') }}",
                                                         type: "POST",
                                                         data: {
                                                             country_id: idCountry,
                                                             _token: '{{ csrf_token() }}'
                                                         },
                                                         dataType: 'json',
                                                         success: function(result) {
                                                             $('#state-dropdown2-{{ $imresult->id }}').html(
                                                                 '<option value="">-- Select Category --</option>');
                                                             $.each(result.states, function(key, value) {
                                                                 $("#state-dropdown2-{{ $imresult->id }}").append(
                                                                     '<option value="' + value
                                                                     .id + '">' + value.name + '</option>');
                                                             });
                                                             $('#city-dropdown2-{{ $imresult->id }}').html(
                                                                 '<option value="">-- Select Contract --</option>');
                                                         }
                                                     });
                                                 });

                                                 /*------------------------------------------
                                                 --------------------------------------------
                                                 State Dropdown Change Event
                                                 --------------------------------------------
                                                 --------------------------------------------*/
                                                 $('#state-dropdown2-{{ $imresult->id }}').on('change', function() {
                                                     var idState = this.value;
                                                     $("#city-dropdown2-{{ $imresult->id }}").html('');
                                                     $.ajax({
                                                         url: "{{ url('fetch-cities') }}",
                                                         type: "POST",
                                                         data: {
                                                             state_id: idState,
                                                             _token: '{{ csrf_token() }}'
                                                         },
                                                         dataType: 'json',
                                                         success: function(res) {
                                                             $('#city-dropdown2-{{ $imresult->id }}').html(
                                                                 '<option value="">-- Select Contract --</option>');
                                                             $.each(res.cities, function(key, value) {
                                                                 $("#city-dropdown2-{{ $imresult->id }}").append(
                                                                     '<option value="' + value
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
                                                 $('#city-dropdown2-{{ $imresult->id }}').on('change', function() {
                                                     var idCity = this.value;
                                                     $("#rate-dropdown-{{ $imresult->id }}").html('');
                                                     $.ajax({
                                                         url: "{{ url('fetch-rate') }}",
                                                         type: "POST",
                                                         data: {
                                                             state_id: idCity,
                                                             _token: '{{ csrf_token() }}'
                                                         },
                                                         dataType: 'json',
                                                         success: function(report) {
                                                             $('#rate-dropdown2-{{ $imresult->id }}').html('');
                                                             $.each(report.rates, function(key, value) {
                                                                 $("#rate-dropdown2-{{ $imresult->id }}").append(
                                                                     '<option value="' + value
                                                                     .im_Rate + '">' + value.im_Rate + '</option>');
                                                             });
                                                         }
                                                     });
                                                 });





                                                 $('#city-dropdown2-{{ $imresult->id }}').on('change', function() {
                                                     var idCity = this.value;
                                                     $("#nominal_value-dropdown2-{{ $imresult->id }}").html('');
                                                     $.ajax({
                                                         url: "{{ url('fetch-nominal_value') }}",
                                                         type: "POST",
                                                         data: {
                                                             state_id: idCity,
                                                             _token: '{{ csrf_token() }}'
                                                         },
                                                         dataType: 'json',
                                                         success: function(nv) {
                                                             $('#nominal_value-dropdown2-{{ $imresult->id }}').html('');
                                                             $.each(nv.nominal_value, function(key, value) {
                                                                 $("#nominal_value-dropdown2-{{ $imresult->id }}").append(
                                                                     '<option value="' +
                                                                     value
                                                                     .nominal_value + '">' + value.nominal_value +
                                                                     '</option>');
                                                             });
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
                                                                 <p class="text-soft">This Data will be delete permanently.
                                                                 </p>
                                                             </div>

                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <form method="POST"
                                                             action="{{ route('deleteim', $imresult->id) }}">
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
                                         <td><b><?php echo number_format($totalNetIM, 2); ?></b></td>
                                     </tr>

                                 </tfoot>
                             </table>

                         </div><!-- compare-table -->
                     </div><!-- col-md-12 -->

                 </div>
             </div><!-- loan-comparison__body -->
             <div class="lowest-emi-note">
                 <a href="{{ url('im_report', $ip) }}">
                     <button class="thm-btn">
                         Calculate Portfolio Initial Margin Obligation
                     </button>
                 </a>
             </div>
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
                     <h5 class="modal-title">Add New Portfolio</h5>
                     <form action="{{ route('im_submit') }}" method="post" class="mt-2">
                         <div class="row g-gs">

                             @csrf

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Market <span
                                         style="color: red;">*</span></label>


                                 <select required name="market" id="country-dropdown" class="form-control">
                                     <option value="">-- Select Market --</option>
                                     @foreach ($countries as $data)
                                         <option value="{{ $data->id }}">
                                             {{ $data->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>

                             <div class="col-md-12">

                                 <label class="form-label" for="inputEmail">Product Category <span
                                         style="color: red;">*</span></label>

                                 <select class="form-control" name="category" id="state-dropdown" required>
                                     <option value="">Select Category</option>

                                 </select>
                             </div>


                             <div class="col-md-12">
                                 <label class="form-label" for="inputEmail">Contract <span
                                         style="color: red;">*</span></label>


                                 <select class="form-control" name="contract" id="city-dropdown" required>
                                     <option value="">Select Contract</option>

                                 </select>
                             </div>



                             <div class="col-md-12">
                                 <label style="font-weight:;">IM Rate <span style="color: red;">*</span></label>
                                 <select disabled class="form-control" name="" id="rate-dropdown" required>


                                 </select>
                             </div>


                             <div class="col-md-12">
                                 <label style="font-weight:;">Nominal Value <span style="color: red;">*</span></label>
                                 <select disabled class="form-control" name="" id="nominal_value-dropdown"
                                     required>


                                 </select>

                             </div><!-- /.col-md-6 -->





                             <div class="col-md-12">
                                 <label class="form-label" for="inputEmail">Net Position (Long/Short) <span
                                         style="color: red;">*</span></label>
                                 <input type="text" name="net_position" class="form-control formattedNumberField"
                                     id="inputEmail" placeholder="0" required>
                             </div>

                             <div class="col-md-12">
                                 <label class="form-label" for="inputEmail">MTM Price <span
                                         style="color: red;">*</span></label>
                                 <input type="text" step="0.01" name="price"
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
                     url: "{{ url('fetch-states') }}",
                     type: "POST",
                     data: {
                         country_id: idCountry,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result) {
                         $('#state-dropdown').html(
                             '<option value="">-- Select Category --</option>');
                         $.each(result.states, function(key, value) {
                             $("#state-dropdown").append('<option value="' + value
                                 .id + '">' + value.name + '</option>');
                         });
                         $('#city-dropdown').html(
                             '<option value="">-- Select Contract --</option>');
                     }
                 });
             });

             /*------------------------------------------
             --------------------------------------------
             State Dropdown Change Event
             --------------------------------------------
             --------------------------------------------*/
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
                         $('#city-dropdown').html(
                             '<option value="">-- Select Contract --</option>');
                         $.each(res.cities, function(key, value) {
                             $("#city-dropdown").append('<option value="' + value
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
             $('#city-dropdown').on('change', function() {
                 var idCity = this.value;
                 $("#rate-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-rate') }}",
                     type: "POST",
                     data: {
                         state_id: idCity,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(report) {
                         $('#rate-dropdown').html('');
                         $.each(report.rates, function(key, value) {
                             $("#rate-dropdown").append('<option value="' + value
                                 .im_Rate + '">' + value.im_Rate + '</option>');
                         });
                     }
                 });
             });





             $('#city-dropdown').on('change', function() {
                 var idCity = this.value;
                 $("#nominal_value-dropdown").html('');
                 $.ajax({
                     url: "{{ url('fetch-nominal_value') }}",
                     type: "POST",
                     data: {
                         state_id: idCity,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(nv) {
                         $('#nominal_value-dropdown').html('');
                         $.each(nv.nominal_value, function(key, value) {
                             $("#nominal_value-dropdown").append('<option value="' +
                                 value
                                 .nominal_value + '">' + value.nominal_value +
                                 '</option>');
                         });
                     }
                 });
             });

         });
     </script>



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
 @endsection
