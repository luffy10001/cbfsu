<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="center-div w-100 d-flex">
        <div style="padding-top: 50px" class="bg-white w-50 leftContainer d-flex flex-column align-items-center">
            <div class="text-center">
                <p class="topHeading">Login</p>
                <p class="headingParaGray">Sign In to your Account</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('/icons/userNameIcon.svg') }}" style="width: 20px; padding:3px "
                         class="bi bi-house listing_i">
                </span>
                    <input name="email" type="email" class="form-control" placeholder="Username" aria-label="Username"
                           aria-describedby="basic-addon1">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                <div class="input-group mb-3 mt-3">
                <span class="input-group-text" id="basic-addon1">

                    <img src="{{ asset('/icons/passwordIcon.svg') }}" style="width: 20px; padding:3px "
                         class="bi bi-house listing_i">

                </span>
                    <input name="password" type="password" class="form-control" placeholder="Password"
                           aria-label="Password" autocomplete="current-password">
                    <span style="position: absolute;right: 8px;top: 12px;" class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>

                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
               {{-- <div class="w-100 d-flex justify-content-end align-items-end">
                    <a href="{{ route('password.request') }}" class="forgetPasswordTag">Forgot Password?</a>

                </div>--}}
                <div class="d-flex justify-content-between align-items-center">


                    <button type="submit" class="formRedButton">Sign In</button>
                </div>
            </form>
        </div>
        <div class="bg-dark w-50 d-flex flex-column justify-content-center align-items-center"
             style="max-height:  100vh; height:434px; overflow: hidden; position: relative;">
            <div class="bg-dark text-center">
                <img src="{{ asset('/icons/graanaLoginLogo.svg') }}" style="width: 192px; margin-bottom: 33px; "
                     class="bi bi-house listing_i">
            </div>
            <p class="powerByImarat text-center " style="position: absolute; bottom: 50px">
                Powered by IMARAT
            </p>
        </div>
    </div>
    <form style="display: none" method="POST" action="{{ route('login') }}">
        @csrf



        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4" toggle="password-parent" style="position: relative">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>

            <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
        </div>

        <!-- Remember Me -->
        <div style="display: none" class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                       name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
    </form>
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
    <style>
        .center-div {
            border: 1px solid #dcdcdc;
        }

        .field-icon {
            top: 40px;
            right: 30px;
            position: absolute;
            z-index: 999999999 !important;
            cursor: pointer;
        }

        .container {
            padding-top: 50px;
            margin: auto;
        }

        div[data-lastpass-icon-root] {
            display: none !important;
        }
    </style>
</x-guest-layout>
