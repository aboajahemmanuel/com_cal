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
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js')}}"></script>
	
	
	<!-------------- CSS Files for example -------------->
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/bootstrap-responsive.css')}}">
	<link rel="stylesheet" href="{{ asset('public/user/assets/css/style.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
	
	<!-------------- Datatable files -------------->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/jquery.dataTables.min.css')}}"/> 
	<script  type="text/javascript" charset="utf8" src="{{ asset('public/user/assets/js/jquery.dataTables.min.js')}}"></script>
	
	
	<script type="text/javascript">
		function isNumberKey(e) {
			var keyCode = (e.which) ? e.which : e.keyCode;
			if ((keyCode >= 48 && keyCode <= 57) || (keyCode == 8)){
				return true;
			}else if (keyCode == 46) {
				var curVal = document.activeElement.value;
			
				if (curVal != null && curVal.trim().indexOf('.') == -1){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		function getMe2DecimalPointsWithCommas(amount) {
			return Number(amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
		}
		
		function formatInputWithComma() {
			$('input.digits').keyup(function (event) {
				// skip for arrow keys
				if (event.which >= 37 && event.which <= 40) {
					event.preventDefault();
				}
				var $this = $(this);
				var num = $this.val().replace(/,/g, '');
				// the following line has been simplified. Revision history contains original.
				$this.val(num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
			});
		}
		
		/*
        $(document).on({
			"contextmenu": function (e) {
				console.log("ctx menu button:", e.which); 

				// Stop the context menu
				e.preventDefault();
			},
			"mousedown": function(e) { 
				console.log("normal mouse down:", e.which); 
			},
			"mouseup": function(e) { 
				console.log("normal mouse up:", e.which); 
			}
		});
        */
	</script>
</head>
   


   
      <div class="main-wrapper">

           
            <!-- Navbar End -->
    

           
            <!-- END SIGN-UP MODAL -->


            @yield('content')
























 

      
   </body>
</html>