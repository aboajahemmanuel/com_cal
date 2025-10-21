<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/css/theme.css') }}">

</head>

<body class="nk-body bg-white npc-general pg-auth">

    @yield('content')
    <div class="nk-footer nk-auth-footer-full">
        <div class="container wide-lg">
            <div class="row g-3">

                <div class="col-lg-12">
                    <div class="nk-block-content text-center text-lg-left">
                        <center>
                            <p>Powered by iQx Consult Limited &copy; @php  echo  $currentMonth = date('Y'); @endphp</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <!-- select region modal -->



</html>
