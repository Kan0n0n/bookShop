@extends('components.layout_clean')
@section('title', 'Verify Email')
@section('childContent')
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="form-container-email-verify">
        <h1>Verify Your Email Address</h1>
        <h3>Before proceeding, please check your email for a verification link.
            <br>
            Please don't close this window until you have verified your email address.
            <br>
            If you close this window before verifying your email address, you will not be able to access the application,
            and you will have to request another verification link.
            If you did not receive the email,
            <form action="{{ route('verification.send') }}" method="post">
                @csrf
                <button type="submit" class="btn">click here to request another</button>
            </form>
            <br>
            Click here to log out <a href="{{ route('logout') }}">Logout</a>
        </h3>
    </div>
@endsection
