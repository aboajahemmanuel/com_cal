@extends('layouts.auth')

@section('content')
    <link href="{{ asset('assets/css/libs/fontawesome-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/libs/themify-icons.css') }}" rel="stylesheet" type="text/css" />

    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s
        -->
                    <div class="nk-content "
                        style="background-image: url( {{ asset('landing_assets/planner.png') }}); background-color: #cccccc; width: 100%; height: 100%;background-position: center;background-repeat: no-repeat; background-size: cover;">
                        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                            <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                                <div class="card card-bordered">

                                    <div class="card-inner card-inner-lg">
                                        <div class="brand-logo pb-4 text-center">
                                            <a href="#" class="logo-link">
                                                <img class="logo-light logo-img logo-img-lg"
                                                    src="{{ asset('images/FMDQlogo.svg') }}"
                                                    srcset="{{ asset('images/FMDQlogo.svg') }}" alt="logo">
                                                <img class="logo-dark logo-img logo-img-lg"
                                                    src="{{ asset('images/FMDQlogo.svg') }}"
                                                    srcset="{{ asset('images/FMDQlogo.svg') }}" alt="logo-dark">
                                            </a>
                                        </div>
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h5 class="nk-block-title">Reset password</h5>
                                                <div class="nk-block-des">
                                                    <p>If you forgot your password, well, then we’ll email you instructions to
                                                        reset your password.</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if (\Session::has('message'))
                                            <div class="alert alert-success alert-dismissible fade show mb-0 text-center"
                                                role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                                <strong>{{ \Session::get('message') }}</strong>
                                            </div>
                                        @endif
                                        <form method="POST" class="mt-4" action="{{ route('Adminforgetpassword') }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="default-01">Email*</label>

                                                </div>
                                                <input type="email" name="email"
                                                    class="form-control form-control-lg  @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" id="default-01"
                                                    placeholder="Enter your email address or username">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div><!-- .foem-group -->
                                            <div class="form-group">
                                                {{-- <button type="submit" class="btn btn-lg btn-primary btn-block">Send Reset Link</button> --}}
                                                <button class="btn btn-lg btn-primary btn-block" name="SUBMIT" id="submit"
                                                    onclick="loading(); setTimeout('document.getElementById(\'' + this.id + '\').disabled=true;', 50);   "
                                                    type="submit">
                                                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                                    <span class="btn-text">Send Password Reset Link</span>
                                                </button>
                                            </div>
                                        </form>
                                        <div class="form-note-s2 text-center pt-4">
                                            <a href="{{ route('login') }}"><strong>Return to login</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- wrap @e -->
                    </div>
                    <!-- content @e -->
                </div>
                <!-- main @e -->
            </div>



            <script>
                function loading() {

                    $(".btn .fa-spinner").show();
                    $(".btn .btn-text").html("");

                    /* var button = document.getElementById("submit");
                     button.innerHTML = "Loading...";
                     var span = document.getElementById("button_span");
                     span.classList.add("spinner-grow");
                     span.classList.add("spinner-grow-sm");*/
                }
            </script>

            <!-- app-root @e -->
            <!-- JavaScript -->
            <script src="{{ asset('assets/js/bundle.js') }}"></script>
            <script src="{{ asset('assets/js/scripts.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $("#btnFetch").click(function() {
                        // disable button
                        $(this).prop("disabled", true);
                        // add spinner to button
                        $(this).html(
                            `<center><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></center>`
                        );
                    });
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        @endsection
