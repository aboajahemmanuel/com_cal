<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<!------------ Assets for Tiva Events Calendar ------------->
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/calendar.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/calendar_full.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/calendar_compact.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- JS Files -->
	<script src="{{ asset('public/user/assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('public/user/assets/js/calendar.js')}}"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js'"></script>
	
	
	<!-------------- CSS Files for example -------------->
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/bootstrap-responsive.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/style.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
	
	<!-------------- Datatable files -------------->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/jquery.dataTables.min.css')}}"/> 
	<script  type="text/javascript" charset="utf8" src="{{ asset('public/user/assets/js/jquery.dataTables.min.js')}}"></script>
	
</head><!-- Header -->

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Initial Margin (Q-Calc)</title>
	    <style id="applicationStylesheet" type="text/css">
		.mediaViewInfo {
			--web-view-name: Q-Estimator – 1;
			--web-view-id: Q-Estimator__1;
			--web-scale-on-resize: true;
			--web-enable-deep-linking: true;
		}
		:root {
			--web-view-ids: Q-Estimator__1;
		}
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			border: none;
		}
		
				/* INDEX.PHP STYLING */
		.main_body {
			padding-top:20px;
			background-color: #fff;
			height:100vh;
			font-family: "Circe Regular", Sans-serif;
		}
		.glossary {
			display: flex;
			justify-content: flex-end;
		}
		.glossary a {
			background:rgba(204,153,51,1);
			color:#fff;
			text-decoration: none;
			padding:20px;
			/* font-family: 'Times New Roman', Times, serif; */
			border-radius:10px;
		}
		.glossary a:hover {
			color:#fff;
		}

		.text {
			margin-top:50px;
			text-align: justify; 
			font-weight: 400; 
			font-size: 17px;
        	font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
			color: #5A5C63; 
		}  
		
		.product_categories {
			margin-top:50px;
			
		}
		.flex {
			display: flex;
			flex-direction: row;
			grid-gap: 1rem; 
			justify-content: center;
			width:100%;
		}
		.div-links {
			
			background-color: rgba(29,43,88,1);
			text-align: right;
			color:#fff;
			font-size: large;
			height:150px;
			padding:10px;
			line-height:140px;
			width: 100%; 
		}
		.div-links:hover {
			color:rgb(204, 153, 51);
		}
		#div-links1 {
			background-image: linear-gradient(rgba(0, 0, 0, 0.627),rgba(0, 0, 0, 0.6)), url('{{ asset('public/user/images/div-links1.png')}}');
			height:150px;
			width:100%;

		}
		#div-links2 {
			background-image: linear-gradient(rgba(0, 0, 0, 0.627),rgba(0, 0, 0, 0.6)), url('{{ asset('public/user/images/div-links2.png')}}');
			height:150px;
			width:100%;

		}
		.flex-box {
			display: flex;
			flex-direction: row;
			gap: 2rem;
		}

		.flex-60 {
			width:60%;
			text-align:justify;
		}

		.flex-60 a {
			text-decoration: none;
		}
		.flex-60 a:hover {
			text-decoration: none;
		}
		
		.flex-10 {
			width:10%;
			text-align:justify;
		}

		.flex-10 a {
			text-decoration: none;
		}
		.flex-10 a:hover {
			text-decoration: none;
		}
		.flex-30 {
			width:30%;
			text-align:justify;
		}

		.flex-30 a {
			text-decoration: none;
		}
		.flex-30 a:hover {
			text-decoration: none;
		}
		
		.flex-box .links {
			background: #121A35;
			padding:25px;
			height:60%;
			display:flex;
			align-items:center;
		}
		.flex-box .links a {
			color:#fff;
			font-size:14px;
			text-transform: uppercase;
			transition:.3s;
		}
		.flex-box .links a:hover {
			color:grey;
		}
		.line {
			width:100%;
			height:2px;
			background:rgba(255,255,255, .5);
			
		}
		@media (max-width:850px) {
			.flex {
				flex-direction: column;
			}
			.flex div {
				width:94%;
			}

		}
		@media (max-width:600px) {
			.flex-box {
				flex-direction: column;
			}
			.flex-50 {
				width:100%;
			}

		}
		/* END OF INDEX.PHP STYLING */
		

		#Product_Category_Section {
			position: absolute;
			width: 100%;
			height: 366px;
			left: 0px;
			top: 344px;
			overflow: visible;
		}
		#Text {
			left: 353px;
			top: 157px;
			position: absolute;
			overflow: visible;
			width: 1px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: bold;
			font-size: 18px;
			color: rgba(255,255,255,1);
			letter-spacing: 0.01px;
		}
		#Rectangle_2234 {
			fill: rgba(241,241,241,1);
		}
		.Rectangle_2234 {
			position: absolute;
			overflow: visible;
			width: 100%;
			height: 366px;
			left: 0px;
			top: 0px;
		}
		#PRODUCT_CATEGORIES {
			/*left: 345px;*/
			
			top: 35px;
			position: absolute;
			overflow: visible;
			width: 317px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: bold;
			font-size: 24px;
			color: rgba(65,66,68,1);
			letter-spacing: 0.01px;
		}
		#Click_on_the_category_you_want {
			/*left: 345px;*/
			left: 10%;
			top: 92px;
			position: absolute;
			overflow: visible;
			width: 373px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: normal;
			font-size: 18px;
			color: rgba(65,66,68,1);
			letter-spacing: 0.05px;
		}
		#Naira_Settled_OTC_FX_Futures {
			position: absolute;
			width: 484px;
			height: 145px;
			/*left: 345px;*/
			
			top: 157px;
			overflow: visible;
		}
		#Rectangle_2235 {
			fill: rgba(29,43,88,1);
		}
		.Rectangle_2235 {
			position: absolute;
			overflow: visible;
			width: 484px;
			height: 145px;
			left: 0px;
			top: 0px;
		}
		#alt_text {
			position: absolute;
			width: 287px;
			height: 26px;
			left: 125px;
			top: 89px;
			overflow: visible;
		}
		#NAIRA_SETTLED_OTC_FX_FUTURES {
			left: 0px;
			top: 0px;
			position: absolute;
			overflow: visible;
			width: 288px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: bold;
			font-size: 18px;
			color: rgba(255,255,255,1);
			letter-spacing: 0.01px;
		}
		#arrow {
			position: absolute;
			width: 8.782px;
			height: 12.298px;
			left: 420.118px;
			top: 94.795px;
			overflow: visible;
		}
		#Path_2896 {
			fill: rgba(204,153,51,1);
		}
		.Path_2896 {
			overflow: visible;
			position: absolute;
			width: 8.782px;
			height: 12.298px;
			left: 0px;
			top: 0px;
			transform: matrix(1,0,0,1,0,0);
		}
		#Interest_Rate_Futures {
			position: absolute;
			width: 484px;
			height: 145px;
			left: 880px; 
			left: 39%;
			top: 157px;
			overflow: visible;
		}
		#Rectangle_2236 {
			fill: rgba(29,43,88,1);
		}
		.Rectangle_2236 {
			position: absolute;
			overflow: visible;
			width: 484px;
			height: 145px;
			left: 0px;
			top: 0px;
		}
		#alt_text_ {
			position: absolute;
			width: 217px;
			height: 26px;
			left: 210px;
			top: 89px;
			overflow: visible;
		}
		#INTEREST_RATE_FUTURES {
			left: 0px;
			top: 0px;
			position: absolute;
			overflow: visible;
			width: 218px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: bold;
			font-size: 18px;
			color: rgba(255,255,255,1);
			letter-spacing: 0.01px;
		}
		#arrow_ {
			position: absolute;
			width: 8.782px;
			height: 12.298px;
			left: 435.118px;
			top: 94.795px;
			overflow: visible;
		}
		#Path_2896_ {
			fill: rgba(204,153,51,1);
		}
		.Path_2896_ {
			overflow: visible;
			position: absolute;
			width: 8.782px;
			height: 12.298px;
			left: 0px;
			top: 0px;
			transform: matrix(1,0,0,1,0,0);
		}
		#Body_Field {
			
			width: 100%;
			height: 174px;
			/* left: 345px; */
			/* left: 10%; */
			
			margin-top: 110px;
			/* overflow: visible; */
		}
		#Q_-_Estimator_is_a_strategic_t {
			
			/* position: absolute; */
			/* overflow: visible; */
			
			/* width: 90%;
			height: 174px;
			text-align: justify;
			font-family: Circe;
			font-style: normal;
			font-weight: normal;
			text-align:justify;
			background:red;
			word-wrap: break-word;
			font-size: 18px;
			color: rgba(90,92,99,1);
			letter-spacing: 0.05px; */
		}
		#Glossary {
			position: absolute;
			width: 200px;
			height: 50px;
			/*left: 1323px;*/
			left: 77.8%;
			top: 20px;
			overflow: visible;
		}
		#Rectangle_2232 {
			fill: rgba(204,153,51,1);
		}
		.Rectangle_2232 {
			position: absolute;
			overflow: visible;
			width: 200px;
			height: 50px;
			left: 0px;
			top: 0px;
		}
		#Group_3644 {
			position: absolute;
			width: 127px;
			height: 26px;
			left: 37px;
			top: 12px;
			overflow: visible;
		}
		#Layer_2 {
			position: absolute;
			width: 24px;
			height: 24px;
			left: 0px;
			top: 0px;
			overflow: visible;
		}
		#book-open {
			position: absolute;
			width: 24px;
			height: 24px;
			left: 0px;
			top: 0px;
			overflow: visible;
		}
		#Rectangle_2233 {
			opacity: 0;
			fill: rgba(255,255,255,1);
		}
		.Rectangle_2233 {
			width: 24px;
			height: 24px;
			position: absolute;
			overflow: visible;
			transform: translate(0px, 0px) matrix(1,0,0,1,0,0) rotate(180deg);
			transform-origin: center;
		}
		#Path_2895 {
			fill: rgba(255,255,255,1);
		}
		.Path_2895 {
			overflow: visible;
			position: absolute;
			width: 18.98px;
			height: 16.089px;
			left: 2.52px;
			top: 4.071px;
			transform: matrix(1,0,0,1,0,0);
		}
		#GLOSSARY {
			left: 33px;
			top: 0px;
			position: absolute;
			overflow: visible;
			width: 95px;
			white-space: nowrap;
			text-align: left;
			font-family: Circe;
			font-style: normal;
			font-weight: bold;
			font-size: 18px;
			color: rgba(255,255,255,1);
			letter-spacing: 0.01px;
		}
	</style>
	
</head>

<body>
	<main class="main_body"><br>
		<div class="d-flex container">
			<div><a href="https://fmdqgroup.com/exchange/"><img src="{{ asset('public/user/images/logo.png')}}" alt="FMDQ_Logo" width="200px"></a></div>
		</div><br>
		<div class="Q-Estimator_Background_header">
			<div class="container">
				<p class="text-white" style="font-size:45px; color:white;"><b>Initial Margin (Q-Calc)</b></p>
				<span class="header-links">
					<a href="index.php">Home</a>
					<span class="text-white" style="font-size:12px"><b><i class='fa fa-angle-double-right'></i></b></span>
				</span>
			</div>
		</div>
		<div style="background:rgb(204, 153, 51);width:100%;height:5px;"></div>
		<div class="container"><br>

			<br><br>
			<div class="glossary">
				<a href="Glossary.php" style="font-size:15px;"><i class="fa fa-book"></i> GLOSSARY</a>
			</div><br><br>

			<div class="flex-box">
				<div class="flex-60">
					<span class="text">
						<p>FMDQ Clear Limited (“FMDQ Clear” or the “CCP”), as part of its value propositions as a Financial Market 
						Infrastructure (“FMI”), seeks to provide CCP clearing services for the soon-to-be launched FMDQ Exchange 
						Traded Derivative (“ETD”) market, with the introduction of FGN Bond Futures that mitigate market risks, 
						serve as investment options, as well diversify investment portfolios. Consequently, FMDQ Clear proposes 
						the introduction of the Initial Margin calculator (the “Q - Calc”) to be used for the estimation of the Initial 
						</p>
						<p>Margin obligation on open/potential FGN Bond Futures positions held by market participants as well as 
						enable Users simulate the collateral amount that will be sufficient to fulfil IM obligations on market 
						exposures.
						</p>
						<p>Initial Margin (“IM”) is the minimum collateral required by the CCP to cover the potential loss and 
						counterparty credit risk that may arise on cleared positions of Clearing Members due to future adverse 
						price movements on executed Bond Futures contract(s)</p>
											</span><br><br>
					<a href="{{url('im_calculate')}}">
						<div style="border-radius:20px;" class="div-links" id="div-links1">
							<p style="font-size:24px;"><b>Initial Margin (Q-Calc) </b><i class="fa fa-caret-right" style="color:rgba(204,153,51,1);font-size:20px;" aria-hidden="true"></i></p>
						</div>
					</a><br>
					
				</div>
				<div class="flex-10">
				</div>
				<div class="flex-30">
					<div style="border-radius:20px;" class="links">
						<div style="width:100%;">
							<a href="https://fmdqgroup.com/exchange/market-products/derivatives/" id="deri1" onmouseover="this.style.color='grey'; this.style.marginLeft = '10px';" onmouseout="this.style.color='#fff'; this.style.marginLeft = '0px';">Derivatives</a>
							<br><br>
							<div class="line"></div><br><br>
							<a href="https://fmdqgroup.com/exchange/market-bulletin/" id="deri2" onmouseover="this.style.color='grey'; this.style.marginLeft = '10px';" onmouseout="this.style.color='#fff'; this.style.marginLeft = '0px';">Derivatives Market Bulletin</a><br><br>
							<div class="line"></div><br><br>
							<a href="https://fmdqgroup.com/exchange/derivatives-market-notice/market-notices/" id="deri3" onmouseover="this.style.color='grey'; this.style.marginLeft = '10px';" onmouseout="this.style.color='#fff'; this.style.marginLeft = '0px';">Derivatives Market Notices</a><br><br>
							<div class="line"></div><br><br>
							<a href="https://fmdqgroup.com/exchange/market-data/" id="deri4" onmouseover="this.style.color='grey'; this.style.marginLeft = '10px';" onmouseout="this.style.color='#fff'; this.style.marginLeft = '0px';">Market Data</a><br><br>
							<div class="line"></div>
						</div>
					</div>
				</div>
			</div>
			<br><br><br>
			<div class="text">Should you require further clarification on FMDQ Derivatives market, kindly contact the Derivatives Business Group via email at <a href="mailto:dbg@fmdqgroup.com">dbg@fmdqgroup.com</a> or call <b>+234-907-035-9954.</b></div>
		</div><br><br><br><br><br><br><br>
		<!DOCTYPE html>

	
</main>
</body>

</html>