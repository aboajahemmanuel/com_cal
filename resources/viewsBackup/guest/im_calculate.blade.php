


<section class="page-header text-start" style="height: 10px !important;">
    <div class="page-header__bg" style="
                        background-image: url(assets/images/Est.jpg);
                    "></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <div style="margin: -100px 0px 0px 0px ;">
            <h2 class="page-header__title">Initial Margin (Q-Calc)</h2>
            <!-- /.page-header__title -->
            <!-- <ul class="list-unstyled breadcrumb-one">
                        <li><a href="index.html">Home</a></li>
                        <li><span>About Us</span></li>
                    </ul> -->
        </div>
        <!-- /.list-unstyled breadcrumb-one -->
    </div>
    <!-- /.container -->
</section>
<!-- /.page-header -->

<section class="about-five">
    <div class="container">
        <div class="row gutter-y-60">


            <div class="col-md-12 col-lg-12">
                <form action="{{route('im_submit')}}" method="post" class="contact-one__form">
                    @csrf
                    <h3 class="contact-one__form__title">Send us Message</h3><!-- /.contact-one__form__title -->
                    <div class="row">
                        <br>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <label style="font-weight: bolder;">Market</label>
                            <select name="market"  id="country-dropdown" class="form-control">
										<option value="">-- Select Market --</option>
										@foreach ($countries as $data)
										<option value="{{$data->id}}">
											{{$data->name}}
										</option>
										@endforeach
									</select>
                        </div>

                        <div class="col-md-12">
                            <label style="font-weight: bolder;">Product Category</label>
                            <select class="form-control" name="category" id="state-dropdown" required>
                                            <option value="">Select Category</option>

                                        </select>
                        </div>

                        <div class="col-md-12">
                            <label style="font-weight: bolder;">Contract</label>
                            <select class="form-control" name="contract" id="city-dropdown" required>
                                            <option value="">Select Contract</option>

                                        </select>
                        </div>

                        <div class="col-md-12">
                            <label style="font-weight: bolder;"> Net Position (Long/Short)</label>
                        <input type="number" name="net_position" class="form-control" id="inputEmail" placeholder="10" required>
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-12">
                            <label style="font-weight: bolder;">Price</label>
                                                                   <input type="number" name="price" class="form-control" id="inputEmail" placeholder="10" required>

                        </div><!-- /.col-md-6 -->

                        <div class="col-md-12">
                            <button type="submit" class="thm-btn thm-btn--three contact-one__btn">
                                <span>
                                  Calculate
                                    <i class="far fa-arrow-right"></i>
                                </span>
                            </button>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </form>
               
            </div><!-- /.col-md-12 -->
            <!-- /.col-md-12 col-lg-7 -->

            <!-- /.col-md-12 col-lg-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.about-five -->



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
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
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
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>

