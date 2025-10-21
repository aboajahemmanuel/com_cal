@extends('layouts.guest')

@section('content')


<section class="page-header text-start" style="height: 10px !important;">
    <div class="page-header__bg" style="
                        background-image: url(../../../guest/assets/images/Est.jpg);
                    "></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <div style="margin: -100px 0px 0px 0px ;">
            <h2 class="page-header__title">Initial Margin (Q-Calc)</h2>
            <!-- /.page-header__title -->
            <ul class="list-unstyled breadcrumb-one">
                        <li><a href="index.html">Home</a></li>
                        <li><span>About Us</span></li>
                    </ul> 
        </div>
        <!-- /.list-unstyled breadcrumb-one -->
    </div>
    <!-- /.container -->
</section>
<!-- /.page-header -->

<section class="about-five">
    <div class="container">
        <div class="row gutter-y-60">
  <style>
        .table {
            font-size: 16px;
            border-collapse: collapse; /* This ensures cell borders are collapsed */
            width: 100%; /* Adjust the width as needed */
        }

        .table th,
        .table td {
            border: 1px solid black; /* Add a border to table cells */
            padding: 8px; /* Add padding for better spacing */
        }

        .table th {
            background-color: #22346c;
            color: white;
        }
    </style>

            <div class="col-md-12 col-lg-12">
                <table class="table">
        <thead>
            <tr>
                <th colspan="10" style="background-color: #22346c; color:white;">
                    <center>Initial Margin Requirement</center>
                </th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>Items</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Total Open Position</b></td>
                <td><b>₦ <?php echo number_format($totalNetPosition, 2) ?></b></td>
            </tr> 
            <tr>
                <td><b>Nominal Value</b></td>
                <td><b>₦ <?php $nominal_value = $totalNetPosition * 50000000; echo number_format($nominal_value, 2) ?></b></td>
            </tr>
            <tr>
                <td><b>IM Obligation</b></td>
                <td><b>₦ <?php echo number_format($totalim_obligation, 2) ?></b></td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <td colspan="20">
                    <center><b>IM Collateral Breakdown</b></center>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Minimum Cash Collateral</b></td>
                <td><b>₦ <?php $cash_collateral = 0.25 * $totalim_obligation; echo number_format($cash_collateral, 2) ?></b></td>
            </tr>
            <tr>
                <td><b>Security Collateral</b></td>
                <td><b>₦ <?php $security_collateral = 0.75 * $totalim_obligation; echo number_format($security_collateral, 2) ?></b></td>
            </tr>
        </tbody>
    </table>
<button onclick="window.location.href = 'another_page.html';">Go to Another Page</button>
            </div><!-- /.col-md-12 -->
            <!-- /.col-md-12 col-lg-7 -->

            <!-- /.col-md-12 col-lg-5 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.about-five -->


@endsection