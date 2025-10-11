@extends('business.master')

@section('title', 'Business Forget')

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

        <p>Enter Your email</p>
        <form method="POST" action="{{route('business.forget_post')}}">
            @csrf
            <ul class="login-ul">
                <li>
                    <input autofill="off" autocomplete="off" class="login-field" type="email" name="email" placeholder="Email" required>
                    <img src="{{asset('business/assets/images/email-icon.svg')}}" alt="icon">
                </li>

            </ul>

            <input class="submit-btn" type="submit" value="Send Recovery E-Mail">
            <span class="create-acc">Don’t have an Business account? <a href="{{route('business.register.page')}}">Create Account</a></span>
        </form>
    </div>
</div>

@stop
