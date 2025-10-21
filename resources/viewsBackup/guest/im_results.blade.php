@extends('layouts.guest')

@section('content')


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

            <a href="#" data-toggle="modal" data-target="#addCustomer" class="thm-btn">
                <span>
                    Goto Home
                    <i class="far fa-arrow-right"></i>
                </span>
            </a>

            <div class="col-md-12 col-lg-12">
                
                                         <table class="table table-bordered table-responsive contact-one__form">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Market</th>
                                                <th scope="col">Product Category</th>
                                                <th scope="col">Contract</th>
                                                <th scope="col">Nominal Value</th>
												  <th scope="col">Price</th>
                                                <th scope="col">Net Posoition (Long/Short)</th>
                                              
                                                <th scope="col"> Initial Margin (N)</th>
                                                <th scope="col"></th>
                                               
                                            </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($im_results as $imresult)
                                            <tr>
                                                <th>{{$imresult->marketName}}</th>
                                                <td>{{$imresult->catName}}</td>
                                                <td>{{$imresult->nominal_value}}</td>
                                                <td>{{$imresult->contractName}}</td>
												 <td>
                                                    <?php echo number_format($imresult->price, 2)?>

                                                  </td>
                                                <td>
                                                    <?php echo number_format($imresult->net_position, 2)?>

                                                  </td>
												 
                                                <td>
                                                    <?php echo number_format($imresult->initial_margin, 2)?>
                                                    </td>
                                                <td>
                                                    <form action="{{route('deleteim', $imresult->id)}}" method="post">
                                                        @csrf
                                                    <button type="submit" class="badge badge-primary" onclick="return confirm('Are you sure you want to delete?');" >Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                             

            
                                              @endforeach
                                            </tbody>
                                             <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td><b></b></td>
                                                        <td><b></b></td>
                                                        <td><b></b></td>
                                                        <td><b></b></td>
                                                        <td><b> <?php echo number_format($totalNetPosition, 2)?></b></td>
                                                        <td><b><?php echo number_format($totalNetIM, 2)?></b></td>
                                                    </tr>
                                                   
                                            </tfoot>
                                            
                                        </table>
                                        
                {{-- <table class="table table-bordered table-responsive`contact-one__form">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Market</th>
                            <th scope="col">Product Category</th>
                            <th scope="col">Contract</th>
                            <th scope="col">Nominal Value</th>
                            <th scope="col">Price</th>
                            <th scope="col">Net Posoition (Long/Short)</th>

                            <th scope="col"> Initial Margin (N)</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th></th>
                            <td>Category</td>
                            <td>Nominal Value</td>
                            <td>uililiki</td>
                            <td>
                                100000000000

                            </td>
                            <td>
                                100000000000

                            </td>

                            <td>
                                100000000000
                            </td>
                            <td>
                                <form action="{{route('deleteim', $imresult->id)}}" method="post">

                                    <button type="submit" class="badge badge-primary" onclick="return confirm('Are you sure you want to delete?');">Delete</button>
                                </form>

                            </td>
                        </tr>




                    </tbody>
                    <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b></b></td>
                            <td><b> 100000000000</b></td>
                            <td><b>100000000000</b></td>
                        </tr>

                    </tfoot>
                </table> --}}
               <div class="col-12">
                            <div class="form-group">
                               <div class="glossary">
                                <a href="{{url('im_report', $ip)}}">Calculate Portfolio IM Obligation</a>
                            </div>
                            </div>
                        </div>
            </div><!-- /.col-md-12 -->
            <!-- /.col-md-12 col-lg-7 -->

            <!-- /.col-md-12 col-lg-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.about-five -->

<div class="modal fade" id="addCustomer">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title">Add New</h5>
                <form action="{{route('im_submit')}}" method="post" class="mt-2">
                    <div class="row g-gs">

                        @csrf

                        <div class="col-md-12">

                            <label class="form-label" for="inputEmail">Market</label>


                            <select name="market" id="country-dropdown" class="form-control">
                                <option value="">-- Select Market --</option>
                                @foreach ($countries as $data)
                                <option value="{{$data->id}}">
                                    {{$data->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">

                            <label class="form-label" for="inputEmail">Product Category</label>

                            <select class="form-control" name="category" id="state-dropdown" required>
                                <option value="">Select Category</option>

                            </select>
                        </div>


                        <div class="col-md-12">
                            <label class="form-label" for="inputEmail">Contract</label>


                            <select class="form-control" name="contract" id="city-dropdown" required>
                                <option value="">Select Contract</option>

                            </select>
                        </div>



                        <div class="col-md-12">
                            <label class="form-label" for="inputEmail">Net Position (Long/Short)</label>
                            <input type="number" name="net_position" class="form-control" id="inputEmail" placeholder="10" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="inputEmail">Price</label>
                            <input type="number" name="price" class="form-control" id="inputEmail" placeholder="10" required>
                        </div>







                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Sunmit</button>
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

@endsection