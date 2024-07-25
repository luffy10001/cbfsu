<x-guest-layout>
    <style>
        .main-container {
            overflow-y: hidden;
            background: #F1F2F4;
            width: 1440px;
            height: 875px;
            top: -2841px;
            left: -251px;

        }
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
            height: 77px;
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
            height: 40px;
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
    </style>

    <div class="main-container">
        <div class="image-container">
            <div class="login-input">
                <img class="login-image" src="{{ asset('/images/login.png') }}">

                <div class="login-input-field-container">
                    <img class="logo" src="{{ asset('/images/LOGO.png') }}">
                    <p class="login-text">Enter Verification Address</p>

                    <!-- Session Status -->

                    @if(!empty(session('is_error')) && session('is_error'))
                        <div class="alert alert-danger" style="color: red;font-size: 13px">
                            {{ session('status') }}
                        </div>
                    @else
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                    @endif

                    @if($errors->has('verification_error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('verification_error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verification.store') }}">
                        @csrf

                        <!-- Email Address -->
                        <label style="color: #555555;" class="form-label">Verification Code</label>
                        <div>
                            <div class="mb-3 position-relative">
                                <input class="form-control login-input-field" type="number" name="verification_code" required>
                                <span class="login-svg-background position-absolute">
                            <img src="{{ asset('/icons/password.svg') }}" class="login-svg">
                        </span>
                            </div>

                            <input class="form-control login-input-field" type="hidden" name="email" value="{!!  $u_email!!}" required >
                        </div>

                        <div class="w-100 mt-3" style="text-align: center">
                            <a href="{{ route('login') }}" class="forgetPasswordTag forgot-password">Back to Login</a>
                        </div>

                        <div class="flex items-center justify-end mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="formRedButton mt-2">Submit</button>
                            </div>

                            {{--                            <x-primary-button>--}}
                            {{--                                {{ __('Submit') }}--}}
                            {{--                            </x-primary-button>--}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="login-illustrator">
                <img src="{{ asset('/images/forgotPassword.png') }}">
            </div>
        </div>
    </div>

</x-guest-layout>
