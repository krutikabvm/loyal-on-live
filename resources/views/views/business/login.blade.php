@extends('business.master')

@section('title', 'Business Login')

@section('content')
<div class="login-screen">
  
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
        <h1>Welcome Back!</h1>
        <p>Log in to you Business account</p>
        <form method="POST" action="{{route('business.login')}}">
            @csrf
            <ul class="login-ul">
                <li>
                    <input autofill="off" autocomplete="off" class="login-field" type="email" name="email" placeholder="Email" required>
                    <img src="{{asset('business/assets/images/email-icon.svg')}}" alt="icon">
                </li>
                <li>
                    <input autofill="off" autocomplete="off" class="login-field" type="password"  name="password" placeholder="Password" required>
                    <img id="pwd" src="{{asset('business/assets/images/eye.svg')}}" alt="icon">
                </li>
            </ul>
            <a href="{{route('forget.page')}}" class="forgot-pas">Forgot Password?</a>
            <input class="submit-btn" type="submit" value="Sign In">
            <span class="create-acc">Don’t have an Business account? <a href="https://www.loyal-iom.com/for-businesses">Create Account</a></span>
        </form>
    </div>
</div>

@stop
