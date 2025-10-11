@extends('business.master')

@section('title', 'Business Login')

@section('content')
<div class="signup-screen">
    
 @if(session('success'))
    <span class="success-msg">{{session('success')}}</span>
@endif

@if(session('error'))
    <span class="error-msg">{{session('error')}}</span>
@endif

    <a href="#" class="login-logo">
        <img src="{{asset('business/assets/images/logo.png')}}" alt="logo">
    </a>
    <div class="login-body">
        <h1>Register Business Account</h1>
        <p>Enter details to continue</p>
        <form method="POST" action="{{route('business.register')}}">
            @csrf
            <ul class="login-ul">
                <li>
                    <input autofill="off" autocomplete="off" class="login-field" type="email" name="email" placeholder="Email" required>
                    <img src="{{asset('business/assets/images/email-icon.svg')}}" alt="icon">
                </li>
                <li>
                    <input autofill="off" class="login-field" type="password" name="password" placeholder="Password" required>
                    <img id="pwd" src="{{asset('business/assets/images/eye.svg')}}" alt="icon">
                </li>
                <li>
                    <input autofill="off" autocomplete="off" class="login-field" type="password" name="c_password" placeholder="Confirm Password" required>
                    <img id="cpwd" src="{{asset('business/assets/images/eye.svg')}}" alt="icon">
                </li>
               
            </ul>
           
            <input class="submit-btn" type="submit" value="Create Account">
            <span class="create-acc">Already have an Business account? <a href="{{route("login")}}">Sign In</a></span>
        </form>
    </div>
</div>


<script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>

@stop
