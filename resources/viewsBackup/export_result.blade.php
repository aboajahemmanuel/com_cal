@include('export_style')

<body class="bg-white">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    {{-- <h3>FMDQ Initial Margin (Q-Calc)</h3> --}}
                    {{-- <img src="{{ public_path('asset\images\logo.png') }}"> --}}
                    <img
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('asset/images/logo.png'))) }}">




                </div>

                <div class="invoice-bills">
                    <div class="table-responsive">
                        @php
                            $postdate = now(); // Get the current date and time using Carbon
                            $newDateFormat = $postdate->format('M. j, Y');
                        @endphp

                        <p><b>{{ $newDateFormat }}</b></p>
                        <h4>Summary</h4>
                        <br>
                        <table class="table table-striped" style="max-width: 908px;  border: 0px solid black;">
                            <h6>Portfolio Builder</h6>
                            <thead class="thead-dark">
                                <tr>
                                    <th style="color: white">
                                        <center>Market</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Product Category</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Contract</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Initial Margin Rate</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Entry Price</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Net Position (Long/Short)</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Nominal Value ($ or ₦)</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Initial Margin (₦)</center>
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
                                            <?php echo number_format($imresult->nominal_value, 2); ?>
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
                                    <td><b> <?php echo number_format($totalNV, 2); ?></b></td>
                                    <td><b><?php echo number_format($totalNetIM_port_builder, 2); ?></b></td>
                                </tr>

                            </tfoot>
                        </table>

                        <br>





                        <table class="table" style="min-width: 535px; max-width: 540px;">

                            <thead class="thead-dark">

                                <tr>
                                    <th style="color: white" scope="col">Required IM Collateral</th>
                                    <th style="color: white" scope="col"><?php echo number_format($totalNetIM_port_builder, 2); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cash Component</td>
                                    <td><?php $cash_collateral = 0.25 * $totalim_obligation;
                                    echo number_format($cash_collateral, 2); ?></td>
                                </tr>
                                <tr>

                                    <td>Non-cash</td>
                                    <td><?php $security_collateral = 0.75 * $totalim_obligation;
                                    echo number_format($security_collateral, 2); ?></td>

                                </tr>

                            </tbody>
                            <br>

                        </table>


                        <table class="table table-striped" style="max-width: 908px;  border: 0px solid black;">
                            <h6>Cash IM Collateral Capture</h6>
                            <thead class="thead-dark">
                                <tr>
                                    <th style="color: white">
                                        <center>Denomination</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Exchange Rate</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Haircut Profile</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Face Value</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Market Value</center>
                                    </th>

                                    {{-- <th></th> --}}

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


                                    </tr>
                                @endforeach



                            </tbody>
                            @if (count($im_results) > 0)

                                <tfoot>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td> </td>
                                        <td><b></b></td>
                                        <td><b><?php echo number_format($totalfacevalue, 2); ?></b></td>


                                        <td><b><?php echo number_format($totalNetIM, 2); ?></b></td>
                                    </tr>


                                </tfoot>


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


                                        @if ($totalNetIM > $cash_collateral)
                                            <td style="background-color: green; color: white"><b>
                                                    <center>Check</center>
                                                </b></td>
                                        @endif



                                    </tr>


                                </tfoot>



                            @endif
                        </table>

                        <br>

                        <table class="table table-striped" style="max-width: 908px;  border: 0px solid black;">
                            <h6>Non Cash IM Collateral Capture</h6>
                            <thead class="thead-dark">
                                <tr>
                                    <th style="color: white">
                                        <center>Security Type</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Security</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Market Price</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Haircut Profile</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Face Value</center>
                                    </th>
                                    <th style="color: white">
                                        <center>Market Value</center>
                                    </th>

                                    {{-- <th></th> --}}

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



                                        <td>
                                            <?php echo number_format($n_imresult->facevalue, 2); ?>

                                        </td>


                                        <td>
                                            <?php echo number_format($n_imresult->marketvalue, 2); ?>

                                        </td>


                                    </tr>
                                @endforeach



                            </tbody>
                            @if (count($n_im_results) > 0)

                                <tfoot>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><b></b></td>
                                        <td><b></b></td>
                                        <td><b></b></td>

                                        <td><b><?php echo number_format($totalNCFACE, 2); ?> </b></td>
                                        <td><b><?php echo number_format($totalMV, 2); ?></b></td>
                                    </tr>

                                </tfoot>



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


                                        @if ($totalMV > $security_collateral)
                                            <td style="background-color: green; color: white"><b>
                                                    <center>Check</center>
                                                </b></td>
                                        @endif
                                    </tr>


                                </tfoot>




                            @endif
                        </table>





                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->
