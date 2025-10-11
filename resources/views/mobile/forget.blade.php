<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>


    @extends('business.master')

    @section('title', 'Business Forget')

    @section('content')
        <div class="login-screen">

            @if (session('success'))
                <h1>{{ session('success') }}</h1>
            @endif

            @if (session('error'))
                <h1>{{ session('error') }}</h1>
            @endif

            <a href="#" class="login-logo">
                <img src="{{ asset('business/assets/images/logo.png') }}" alt="logo">
            </a>
            <div class="login-body">

                @if ($error == 0)
                    <div class="card" style="border:none">

                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Update password</h2>

                            <form id="reset_form" method="POST" action="{{ route('reset.form.submit') }}">
                                @csrf

                                <input type="hidden" name="reset_token" value="{{ $data['token'] }}">
                                <input type="hidden" name="e" value="{{ $data['email'] }}">
                                <div class="form-outline mb-4">


                                    <input type="email" id="email" value="{{ $data['email'] }}" disabled
                                        name="email" class="form-control form-control-lg" />
                                    <label class="form-label" for="email">Email</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" required name="password" id="p1"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="p1">Password</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" required name="c_password" id="p2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="p2">Repeat your password</label>
                                </div>



                                <div class="d-flex justify-content-center">
                                    <input class="submit-btn" type="submit" value="Update">
                                    <!--        <button type="submit" style="width:100%;background-color: deeppink;-->
          <!--color: white;" class="btn btn-dangerbtn-block  btn-lg ">Update</button>-->
                                </div>



                            </form>

                        </div>
                    </div>
                @elseif($error == 1)
                    <div class="card" style="border:none">

                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-danger text-center mb-5">
                                @if (isset($message))
                                    {{ $message }}
                                @else
                                    Try Again!
                                @endif
                            </h2>

                            <div class="text-center">
                                <img class="rounded" alt="Cross icon" width="100px"alt="Responsive image"
                                    src="{{ asset('images/cross_icon.png') }}">

                            </div>



                        </div>
                    </div>
                @else
                    <div class="card" style="border:none">

                        <div class="card-body ">
                            <h2 class="text-uppercase text-success text-center ">
                                @if (isset($message))
                                    {{ $message }}
                                @else
                                    Updated
                                @endif
                            </h2>

                            <div class="text-center">
                                <img class="rounded" alt="Cross icon" width="100px"alt="Responsive image"
                                    src="{{ asset('images/tick_icon.png') }}">
                                    <p class="text-uppercase text-success text-center mb-5">Return to App and press Continue</p>
                            </div>



                        </div>
                    </div>
                @endif
            </div>
        </div>

    @stop
