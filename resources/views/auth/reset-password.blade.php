<x-guest-layout>
    <style>
        .image-container {
            display: flex;
            gap: 20px; /* Adjust gap as needed */
        }

        .login-input {
            width: 480px;
            height: 882px;
            gap: 0px;
            opacity: 0.4px;

        }

        .login-input {
            background: #ffffff;
            width: 480px;
            height: 875px;
            gap: 0px;
            opacity: 0.4px;
        }

        .login-image {
            width: 882px;
            height: 875px;
            top: 64px;
            left: -402px;
            gap: 0px;
            opacity: 0px;
        }
        .login-input-field-container {
            width: 410px;
            height: 484px;
            position: absolute; /* Use absolute positioning if needed */
            top: 195px;
            left: 35px;
            gap: 0px;
            opacity: 1; /* Change to 1 to make it visible */
            /*border: 1px solid black;*/
        }

        .logo {
            margin-left: 115px;
            margin-bottom: 40px;
            /*height: 77px;*/
            width: 184px;
            top: 195px;
            left: 148px;
        }
        .login-text{
            text-align: center;
            /*width: 231px;*/
            height: 24px;
            top: 312px;
            left: 119px;
            font-family: Inter;
            font-size: 20px;
            font-weight: 700;
            line-height: 24.2px;


        }
        .login-input-field{
            width: 387px;
            height: 50px;
            /*top: 410px;*/
            /*left: 35px;*/
            /*border-radius: 8px;*/
            background-color: #F1F3F6; !important;

        }
        .login-svg {
            margin: 4px 0 0 12px;
            width: 24px;
            height: 24px;
            top: 423px;
            left: 408px;
        }

        .login-svg-background{
            width: 50px;
            /*height: 50px;*/
            top: 410px;
            left: 359px;
            gap: 0px;
            border-radius: 8px;
            background: #285F6B;
            display: flex;
            align-items: center;
            height: 100%;

        }
        .forgot-password {
            width: 119px;
            height: 17px;
            top: 588px;
            left: 321px;
            color: #77CBD8;
            font-family: Inter;
            font-size: 15px;
            font-weight: 400;
            line-height: 16.94px;

        }

        .login-illustrator {
            width: 632px;
            height: 632px;
            top: 121px;
            left: 644px;
            gap: 0px;
            opacity: 0px;
            margin: 110px 100px 100px 130px;
        }

        .field-icon {
            top: 40px;
            right: 30px;
            position: absolute;
            z-index: 999999999 !important;
            cursor: pointer;
        }


        div[data-lastpass-icon-root] {
            display: none !important;
        }
        .formRedButton {
            top: 629px;
            left: 35px;
            align-items: center;
            background: #285F6B;
            border: 1px solid #285F6B;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            flex-shrink: 0;
            gap: 10px;
            height: 50px;
            justify-content: center;
            outline: none;
            width: 410px;
            font-family: Inter;
            font-size: 16px;
            font-weight: 600;
            line-height: 19.36px;

        }

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
            top: 0;
            right: 0;

        }

        .btn-disabled {
            background-color: #285f6b70; /* Custom color for disabled button */
            border-color: #285f6b70; /* Optional: If you want the border to match */
            color: #fff; /* Optional: Text color to ensure readability */
        }
    </style>
    <!-- Session Status -->
    <div class="image-container">
        <div class="login-input">
            <img class="login-image" src="{{ asset('/images/login.png') }}">

            <div class="login-input-field-container">
                <img class="logo" src="{{ asset('/images/LOGO.png') }}">
                <p class="login-text">Reset Password</p>

                <form method="POST" action="{{ route('new-password.store') }}">
                    @csrf
                    <label style="color: #555555;" class="form-label">Enter New Password</label>
                    <div class="mb-3 position-relative">
                        <input name="password" type="password" class="form-control login-input-field" placeholder="***********" aria-label="Username" aria-describedby="basic-addon1">
                        <span class="login-svg-background position-absolute">
                            <img src="{{ asset('/assets/icons/password.svg') }}"  class="login-svg">
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <label style="color: #555555;" class="form-label">Confirm Password</label>
                    <div class="mb-3 mt-2 position-relative">
                        <input name="conf_password" type="password" class="form-control login-input-field" placeholder="***********" aria-label="Password" >
                        <span class="login-svg-background position-absolute">
                            <img src="{{ asset('/assets/icons/password.svg') }}"  class="login-svg">
                        </span>
                        {{--                        <span style="position: absolute;right: 8px;top: 12px;" class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>--}}
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                    <input type="hidden" name="u_email" value="{{ old('u_email', session('u_email')) }}">

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" id="submit-btn" class="formRedButton mt-4 btn-disabled"  disabled>Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="login-illustrator">
            <img src="{{ asset('/images/forgotPassword.png') }}">
        </div>

        {{--        <div style="padding-top: 50px" class="bg-white w-50 leftContainer d-flex flex-column align-items-center">--}}
        {{--            <div class="text-center">--}}
        {{--                <p class="topHeading">Login</p>--}}
        {{--                <p class="headingParaGray">Sign In to your Account</p>--}}
        {{--            </div>--}}
        {{--            <form method="POST" action="{{ route('login') }}">--}}
        {{--                @csrf--}}
        {{--                <div class="input-group mb-3">--}}
        {{--                <span class="input-group-text" id="basic-addon1">--}}
        {{--                    <img src="{{ asset('/assets/icons/userNameIcon.svg') }}" style="width: 20px; padding:3px "--}}
        {{--                         class="bi bi-house listing_i">--}}
        {{--                </span>--}}
        {{--                    <input name="email" type="email" class="form-control" placeholder="Username" aria-label="Username"--}}
        {{--                           aria-describedby="basic-addon1">--}}
        {{--                </div>--}}
        {{--                <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
        {{--                <div class="input-group mb-3 mt-3">--}}
        {{--                <span class="input-group-text" id="basic-addon1">--}}

        {{--                    <img src="{{ asset('/assets/icons/passwordIcon.svg') }}" style="width: 20px; padding:3px "--}}
        {{--                         class="bi bi-house listing_i">--}}

        {{--                </span>--}}
        {{--                    <input name="password" type="password" class="form-control" placeholder="Password"--}}
        {{--                           aria-label="Password" autocomplete="current-password">--}}
        {{--                    <span style="position: absolute;right: 8px;top: 12px;" class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>--}}

        {{--                </div>--}}
        {{--                <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
        {{--                <div class="w-100 d-flex justify-content-end align-items-end">--}}
        {{--                    <a href="{{ route('password.request') }}" class="forgetPasswordTag">Forgot Password?</a>--}}

        {{--                </div>--}}
        {{--                <div class="d-flex justify-content-between align-items-center">--}}


        {{--                    <button type="submit" class="formRedButton">Sign In</button>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--        </div>--}}

        {{--        <div class="bg-dark w-50 d-flex flex-column justify-content-center align-items-center"--}}
        {{--             style="max-height:  100vh; height:434px; overflow: hidden; position: relative;">--}}
        {{--            <div class="bg-dark text-center">--}}
        {{--                <h2 style="color:#ffff ;">HIV <br> Program Management System</h2>--}}
        {{--                <img src="{{ asset('/assets/icons/graanaLoginLogo.svg') }}" style="width: 192px; margin-bottom: 33px; "--}}
        {{--                     class="bi bi-house listing_i">--}}
        {{--            </div>--}}
        {{--            <p class="powerByImarat text-center " style="position: absolute; bottom: 50px">--}}
        {{--                Powered by HIV Program Management System--}}
        {{--            </p>--}}
        {{--        </div>--}}
    </div>
{{--    <form style="display: none" method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}
{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label  :value="__('Email')"/>--}}
{{--            <input  class="block mt-1 w-full" type="password" name="password" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4" toggle="password-parent" style="position: relative">--}}
{{--            <x-input-label for="password" :value="__('Password')"/>--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                          type="password"--}}
{{--                          name="conf_password"--}}
{{--                          required />--}}

{{--            <x-input-error :messages="$errors->get('conf_password')" class="mt-2"/>--}}

{{--            <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div style="display: none" class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox"--}}
{{--                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"--}}
{{--                       name="remember">--}}
{{--                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"--}}
{{--                   href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ml-3">--}}
{{--                {{ __('Sign in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"
            integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("body").on('click', '.toggle-password', function () {
                const elem = $(this);
                const passwordField = elem.parents(`div[toggle="password-parent"]`);
                var fieldType = passwordField.find('input').attr("type");

                if (fieldType === "password") {
                    passwordField.find('input').attr("type", "text");
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    passwordField.find('input').attr("type", "password");
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</x-guest-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function checkInputs() {
            var password = $('input[name="password"]').val();
            var confPassword = $('input[name="conf_password"]').val();
            var isPasswordValid = password.length >= 8;
            var arePasswordsMatching = password === confPassword;

            if (isPasswordValid && arePasswordsMatching) {
                $('#submit-btn').prop('disabled', false).removeClass('btn-disabled');
            } else {
                $('#submit-btn').prop('disabled', true).addClass('btn-disabled');
            }
        }

        // Check inputs on keyup and input events
        $('input[name="password"], input[name="conf_password"]').on('keyup input', function() {
            checkInputs();
        });
    });
</script>

