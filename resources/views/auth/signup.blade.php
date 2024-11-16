@extends('components.layout_clean')

@section('title', 'Register')

@section('childContent')
    <div class="form-container">

        <form action="{{ route('signup.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3>register now</h3>
            <div class="form-group">
                <label for="avatar" class="image-label">
                    <input type="file" name="avatar_path" id="avatar"
                        class="image-input @error('avatar_path') is-invalid @enderror" accept="image/*"
                        oninput="previewImage(event)">
                    <div class=image-placeholder>
                        <img src="{{ asset('images/avatarUpload/placeholder.png') }}" alt="avatar" class="avatar-img"
                            id="avatar-img">
                        <div class="image-overlay">
                            <p class="image-label-name">choose your avatar</p>
                        </div>
                    </div>
                </label>
                @error('avatar')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="name" placeholder="enter your name" required
                    class="box @error('name') is-invalid @enderror">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="enter your email" required
                    class="box @error('email') is-invalid @enderror">
                @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="enter your password" required
                    class="box @error('password') is-invalid @enderror">
                @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="confirm your password" required
                    class="box @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="date" name="date_of_birth" required
                    class="box @error('date_of_birth') is-invalid @enderror">
                @error('date_of_birth')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="enter your address" required
                    class="box @error('address') is-invalid @enderror">
                @error('address')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="enter your phone" required
                    class="box @error('phone') is-invalid @enderror">
                @error('phone')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="radio">
                <input type="radio" id="male" name="gerne" value="male" checked>
                <label for="male">male</label>
                <input type="radio" id="female" name="gerne" value="female">
                <label for="female">female</label>
                <input type="radio" id="other" name="gerne" value="other">
                <label for="other">other</label>
                @error('gerne')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account? <a href="{{ route('login') }}">login now</a></p>
        </form>
    </div>
@endsection
