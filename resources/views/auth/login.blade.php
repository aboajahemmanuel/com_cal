@extends('layouts.auth')

@section('content')


    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                    <div class="nk-content "
                        style="background-image: url( {{ asset('landing_assets/planner.png') }}); background-color: #cccccc; width: 100%; height: 100%;background-position: center;background-repeat: no-repeat; background-size: cover;">
                        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                            <div class="card card-bordered">
                                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                                    <div class="brand-logo pb-4 text-center">
                                        <a href="#" class="logo-link">
                                            <img class="logo-light logo-img logo-img-lg"
                                                src="{{ asset('images/FMDQlogo.svg') }}"
                                                srcset="{{ asset('images/FMDQlogo.svg') }}" alt="logo">
                                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/FMDQlogo.svg') }}"
                                                srcset="{{ asset('images/FMDQlogo.svg') }}" alt="logo-dark">


                                        </a>
                                    </div>
                                    <div class="card-inner card-inner-lg">
                                        <center>
                                            <h4>Corporate Action Calendar </h4>
                                        </center>
                                        <br>
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Sign-In</h4>
                                                <div class="nk-block-des">
                                                    {{-- <p>Access the Admin Panel using your email and password.</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="example-alert">
                                            @if (\Session::has('error'))
                                                <div class="alert alert-danger alert-icon alert-dismissible">
                                                    <em class="icon ni ni-check-circle"></em> <strong>
                                                        {{ \Session::get('error') }}<button class="close"
                                                            data-dismiss="alert"></button>
                                                </div>
                                            @endif



                                            @if (\Session::has('success'))
                                                <div class="alert alert-success alert-icon alert-dismissible">
                                                    <em class="icon ni ni-check-circle"></em> <strong>
                                                        {{ \Session::get('success') }}<button class="close"
                                                            data-dismiss="alert"></button>
                                                </div>
                                            @endif


                                            @if (count($errors) > 0)
                                                <div>
                                                    <div class="alert alert-danger alert-icon alert-dismissible">
                                                        <strong>Opps!</strong> Something went wrong, please check below
                                                        errors.<br><br>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <button class="close" data-dismiss="alert"></button>
                                                    </div>
                                            @endif




                                        </div>

                                        <form method="POST" action="{{ route('Adminlogin') }}" id="ordersubmitform">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="default-01">Email *</label>

                                                </div>
                                                <input type="email" name="email"
                                                    class="form-control form-control-lg  @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" id="default-01"
                                                    placeholder="Enter your email address">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div><!-- .foem-group -->
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="password">Password *</label>
                                                    @if (Route::has('password.request'))
                                                        <a class="link link-primary link-sm" tabindex="-1"
                                                            href="{{ route('password.request') }}">Forgot Password?</a>
                                                    @endif

                                                </div>
                                                <div class="form-control-wrap">
                                                    <a tabindex="-1" href="#"
                                                        class="form-icon form-icon-right passcode-switch"
                                                        data-target="password">
                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    </a>
                                                    <input type="password" name="password"
                                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                        id="password" placeholder="Enter your password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div><!-- .foem-group -->
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary btn-block" name="SUBMIT" id="submit"
                                                    onclick="loading(); setTimeout('document.getElementById(\'' + this.id + '\').disabled=true;', 50);   "
                                                    type="submit">
                                                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                                    <span class="btn-text">Sign in</span>
                                                </button>

                                            </div>
                                        </form>






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





        @endsection
