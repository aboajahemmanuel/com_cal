@extends('layouts.auth')

@section('content')
    <!-- content @s
                                                                                                                                                        -->
        <div class="nk-content">

            <div class="nk-block nk-block-middle nk-auth-body  wide-xs">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if (Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                                class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach

                <div class="card card-bordered">
                    <div class="card-inner card-inner-lg">
                        <div class="nk-block-head">
                            <div class="brand-logo pb-4 text-center">
                                <a href="#" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/FMDQlogo.svg') }}"
                                        srcset="{{ asset('images/FMDQlogo.svg') }} 1x" alt="logo">

                                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/FMDQlogo.svg') }}"
                                        srcset="{{ asset('images/FMDQlogo.svg') }} 1x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-block-head-content">
                                {{-- <h4>Financial Markets Regulations & Rules Repository Portal</h4> --}}
                                <br>
                                <div class="nk-block-des">
                                    <h6 class="nk-block-title">Reset Password</h6>

                                    {{-- <p>Access the Q-Depository Onboarding Portal using your email and password.</p> --}}
                                </div>

                            </div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success text-center mb-4" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center mb-4" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div>
                                <div class="alert alert-danger alert-icon alert-dismissible">
                                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="close" data-dismiss="alert"></button>
                                </div>
                        @endif
                        <form method="POST" action="{{ route('password_update') }}">
                            @csrf



                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="default-01"></label>

                                </div>
                                <input type="email" hidden name="email" value="{{ $email }}"
                                    class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" id="default-01"
                                    placeholder="Enter your email address or username">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- .foem-group -->

                            <!-- .foem-group -->
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">Password*</label>


                                </div>

                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch"
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
                                    <p>
                                    <h6>Password Policy</h6>
                                    </p>
                                    <ul class="list-unstyled">
                                        <li>- Password must contain at least eight characters</li>
                                        <li>- Password must be different from username</li>
                                        <li>- Password must contain at least one number (0-9)</li>
                                        <li>- Password must contain at least one lowercase letter (a-z)</li>
                                        <li>- Password must contain at least one uppercase letter (A-Z)</li>
                                        <li>- Password must contain at least one special character</li>
                                    </ul>
                                </div>
                            </div><!-- .foem-group -->

                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">Confirm Password</label>

                                </div>
                                <div class="form-control-wrap">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="confirm_password" placeholder="Confirm your password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" name="SUBMIT" id="submit"
                                    onclick="loading(); setTimeout('document.getElementById(\'' + this.id + '\').disabled=true;', 50);   "
                                    type="submit">
                                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                                    <span class="btn-text">Reset</span>
                                </button>

                            </div>

                        </form>



                    </div>
                </div>
            </div>
        @endsection
