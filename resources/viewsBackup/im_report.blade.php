 @extends('layouts.external')

 @section('content')
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
                 <li><span> <a href="{{ url('im_results', $ip) }}">Initial Margin Requirement Report</a></span></li>
                 <b>
                     <li><span>Initial Margin Requirement Report</span></li>
                 </b>
             </ul><!-- /.thm-breadcrumb list-unstyled -->
         </div><!-- /.container -->
     </section><!-- /.page-header -->
     <section class="loan-Calculator pt-50 pb-120">

         {{-- <section class="loan-Calculator pt-120 pb-120"> --}}
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


             <div class="loan-comparison__body" id="compare-emi-1">

                 <div class="row">

                     <div class="col-md-12">
                         <div class="compare-table table-responsive">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th colspan="10"
                                             style="background-color: #22346c; color:white; font-size: 20px;">
                                             <center>Initial Margin Requirement</center>
                                         </th>
                                     </tr>
                                 </thead>
                                 <thead>
                                     <tr>
                                         <th style="font-size: 17px;">Items</th>
                                         <th style="font-size: 17px;">Value</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td><b>Total Open Position</b></td>
                                         <td><b>{{ $totalNetPosition }}</b></td>
                                         {{-- <td><b>₦ <?php echo number_format($totalNetPosition, 2); ?></b></td> --}}
                                     </tr>
                                     {{-- <tr>
                                         <td><b>Nominal Value</b></td>
                                         <td><b>₦ <?php echo number_format($totalNV, 2); ?></b></td>
                                     </tr> --}}
                                     <tr>
                                         <td><b>Initial Margin Obligation</b></td>
                                         <td><b>₦ <?php echo number_format($totalim_obligation, 2); ?></b></td>
                                     </tr>
                                 </tbody>
                                 <thead>
                                     <tr>
                                         <td colspan="20">
                                             <center><b>Initial Margin Collateral Breakdown</b></center>
                                         </td>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td><b>Minimum Cash Collateral</b></td>
                                         <td><b>₦ <?php $cash_collateral = 0.25 * $totalim_obligation;
                                         echo number_format($cash_collateral, 2); ?></b></td>
                                     </tr>
                                     <tr>
                                         <td><b>Security Collateral</b></td>
                                         <td><b>₦ <?php $security_collateral = 0.75 * $totalim_obligation;
                                         echo number_format($security_collateral, 2); ?></b></td>
                                     </tr>
                                 </tbody>
                             </table>

                         </div><!-- compare-table -->
                     </div><!-- col-md-12 -->

                 </div>
             </div><!-- loan-comparison__body -->
             <div class="lowest-emi-note">
                 <a href="{{ url('im_results', $ip) }}">
                     <button class="thm-btn">
                         Portfolio Builder
                     </button>
                 </a>

                 &nbsp;&nbsp;&nbsp;
                 <a href="{{ url('collateral_report', $ip) }}">
                     <button class="thm-btn">
                         Collateral Report
                     </button>
                 </a>


             </div>



         </div> <!-- container -->
     </section> <!-- calculator -->
 @endsection
