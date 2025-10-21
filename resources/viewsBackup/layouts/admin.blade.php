<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Corporate Action Calendar for FMDQ Private Markets Limited">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('asset/images/logo.png') }}">
    <!-- Page Title  -->
    <title>Corporate Action Calendar for FMDQ Private Markets Limited</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <style>
    /* Preloader Styling */
    #preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(0, 0, 0, 0.1);
        border-left-color: #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
</div>


            @include('layouts.adminsidebar')
            @include('layouts.adminheader')

            @yield('content')


            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        {{-- <div class="nk-footer-copyright"> &copy; <script>document.write(new Date().getFullYear())</script> FMDQ GROUP
                            </div> --}}
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">

                                <li class="nav-item">
                                    <p class="mb-0 text-muted"> Powered By iQx Consult Limited &copy;
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <script src="{{ asset('assets/js/bundle.js') }}"></script>
            <script src="{{ asset('assets/js/scripts.js') }}"></script>
            {{-- <script src="{{ asset('assets/js/charts/chart-crm.js') }}"></script> --}}
            <script src="{{ asset('assets/js/libs/datatable-btns.js') }}"></script>

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script>
    // Wait for the full page to load, then hide the preloader and show content
    window.addEventListener("load", function() {
        document.getElementById("preloader").style.display = "none";
        document.getElementById("content").style.display = "block";
    });
</script>
</body>

</html>
