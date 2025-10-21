 @extends('layouts.external')

@section('content')



          <div class="stricky-header stricked-menu main-menu">
              <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
          </div><!-- /.stricky-header -->
          <section class="page-header">
                <div class="page-header__bg" style="background-image: url({{ asset('asset/images/Est.jpg')}});"></div>
              <!-- /.page-header__bg -->
              <div class="container">
                 
                  <h2>Initial Margin (Q-Calc)</h2>
                  	&nbsp;
                   <ul class="thm-breadcrumb list-unstyled">
                      <li><span><a href="{{url('/')}}">Home</a></span></li>
                      <li><span>Portfolio Builder</span></li>
                  </ul><!-- /.thm-breadcrumb list-unstyled -->
              </div><!-- /.container -->
          </section><!-- /.page-header -->
          <section class="loan-Calculator pt-120 pb-120">
              <div class="container">
                  <div class="loan-calculator__top">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="block-title text-left">

                                  <h2 class="block-title__title">Initial Margin (Q-Calc)</h2><!-- block-title__title -->
                              </div><!-- block-title -->
                          </div><!-- col-md-6 -->
                          <!-- <div class="col-md-6">
                            <p class="loan-calculator__top__text">Nullam vel nibh facilisis lectus fermentum ultrices quis non
                                risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea
                                dictumst.</p>
                        </div> -->
                      </div><!-- row -->
                  </div><!-- loan_calculator_top -->
                  <form action="{{route('im_submit')}}" method="post" class="contact-one__form">
                    @csrf
                  
                    <div class="row">
                       
                        <div class="col-md-6">
                            <label style="font-weight: bolder;">Market</label>
                            <select required name="market"  id="country-dropdown" class="form-control">
										<option value="">-- Select Market --</option>
										@foreach ($countries as $data)
										<option value="{{$data->id}}">
											{{$data->name}}
										</option>
										@endforeach
									</select>
                        </div>

                        <div class="col-md-6">
                            <label style="font-weight: bolder;">Product Category</label>
                            <select class="form-control" name="category" id="state-dropdown" required>
                                            <option value="">-- Select Category --</option>

                                        </select>
                        </div>

                    </div>
                    <br>

                     <div class="row">

                        <div class="col-md-6">
                            <label style="font-weight: bolder;">Contract</label>
                            <select class="form-control" name="contract" id="city-dropdown" required>
                                            <option value="">-- Select Contract --</option>

                                        </select>
                        </div>


                        <div class="col-md-6">
                            <label style="font-weight: bolder;">Rate</label>
                            <select disabled class="form-control" name="" id="rate-dropdown" required>
                                           

                                        </select>
                        </div>

                     

                        

                         </div>
                         <br>
                         <div class="row">
                               <div class="col-md-6">
                            <label style="font-weight: bolder;"> Net Position (Long/Short)</label>
                        <input type="number" name="net_position" class="form-control" id="inputEmail" placeholder="Enter Value" required>
                        </div><!-- /.col-md-6 -->
                             <div class="col-md-6">
                            <label style="font-weight: bolder;">Nominal Value</label>
                        <select disabled class="form-control" name="" id="nominal_value-dropdown" required>
                                           

                                        </select>

                        </div><!-- /.col-md-6 -->
                        
                         </div>
                         <br>
                         <div class="row">
                             <div class="col-md-6">
                            <label style="font-weight: bolder;">MTM Price</label>
                         <input type="number" name="price" class="form-control" id="inputEmail" placeholder="Enter Value" required>

                        </div><!-- /.col-md-6 -->

                         </div>
                        <br>
                         <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="thm-btn thm-btn--three contact-one__btn">
                                <span>
                                  Calculate
                                </span>
                            </button>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </form>
               

              </div> <!-- container -->
          </section> <!-- calculator -->


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
  
            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select Category --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select Contract --</option>');
                    }
                });
            });
  
            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#state-dropdown').on('change', function () {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{url('fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dropdown').html('<option value="">-- Select Contract --</option>');
                        $.each(res.cities, function (key, value) {
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
            $('#city-dropdown').on('change', function () {
                var idCity = this.value;
                $("#rate-dropdown").html('');
                $.ajax({
                    url: "{{url('fetch-rate')}}",
                    type: "POST",
                    data: {
                        state_id: idCity,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (report) {
                        $('#rate-dropdown').html('');
                        $.each(report.rates, function (key, value) {
                            $("#rate-dropdown").append('<option value="' + value
                                .im_Rate + '">' + value.im_Rate + '</option>');
                        });
                    }
                });
            });
  




             $('#city-dropdown').on('change', function () {
                var idCity = this.value;
                $("#nominal_value-dropdown").html('');
                $.ajax({
                    url: "{{url('fetch-nominal_value')}}",
                    type: "POST",
                    data: {
                        state_id: idCity,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (nv) {
                        $('#nominal_value-dropdown').html('');
                        $.each(nv.nominal_value, function (key, value) {
                            $("#nominal_value-dropdown").append('<option value="' + value
                                .nominal_value + '">' + value.nominal_value + '</option>');
                        });
                    }
                });
            });
  
        });



        
    </script>


           @endsection