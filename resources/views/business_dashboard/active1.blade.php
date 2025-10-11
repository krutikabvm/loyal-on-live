<!DOCTYPE html>

<html lang="en">

<head>

    <title>Activate</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.png">

    <link rel="stylesheet" href="{{ url('') }}/admin_dashboard/assets/css/style.css" type="text/css">

</head>
<style>
    body {
        background-color: #808393 !important;
    }
</style>

<body>
    <div style="float: right;margin-right: 50px;margin-top: 27px;"><a href="{{ url('') }}/business/login"
            class="logout-btn" style="font-size: 23px;">Back</a></div>

    <div class="active-screen active-now">
        @if (session('error'))
            <span class="error-msg">{{ session('error') }}</span>
        @endif
        <div class="active-body">

            <h1 class="activ-head">ACTIVATE YOUR LOYAL IOM ACCOUNT</h1>

            <form method="post" action="{{ route('business.activate_account') }}">
                <div class="active-key-main">

                    <h3>Enter your 4 digit activation code below:</h3>

                    @csrf
                    <div class="key-outer">

                        <input type="text" maxlength="1" placeholder="" name="digit1" required>

                        <input type="text" maxlength="1" placeholder="" name="digit2" required>

                        <input type="text" maxlength="1" placeholder="" name="digit3" required>

                        <input type="text" maxlength="1" placeholder="" name="digit4" required>

                    </div>


                </div>

                <button type="submit" class="acti-close-btn">ACTIVATE ACCOUNT NOW</button>
            </form>

        </div>

    </div>



</body>

</html>
