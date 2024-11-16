@extends('components.layout_clean')
@section('title', 'Login')
@section('childContent')
    <div class="form-container">

        <form action="{{ route('login.post') }}" method="post">
            <h3>login now</h3>
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="enter your email" required
                    class="box @error('email') is-invalid @enderror">
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="enter your password" required
                    class="box @error('password') is-invalid @enderror">
                @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
            </div>
            <input type="submit" name="submit" value="login now" class="btn">
            <p>don't have an account? <a href="{{ route('signup') }}">register now</a></p>
        </form>

    </div>
@endsection
