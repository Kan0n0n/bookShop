@extends('components.layout')
@section('title', 'About Us')
@section('content')
    <div class="heading">
        <h3>about us</h3>
        <p> <a href="{{ route('index') }}">home</a> / about </p>
    </div>

    <section class="authors">

        <h1 class="title">Behold those who create this ... thing</h1>

        <div class="box-container">

            <div class="box">
                <img src="{{ asset('images/ourInfo/aria.jpg') }}" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Trần Đức Tài>
            </div>

            <div class="box">
                <img src="{{ asset('images/ourInfo/Loan.png') }} " alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Nguyễn Ngọc Loan</h3>
            </div>

            <div class="box">
                <img src="{{ asset('images/ourInfo/Phat.png') }}" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Trần Thuận Phát</h3>
            </div>

            <div class="box">
                <img src="{{ asset('images/ourInfo/Tuan.png') }}" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Trần Văn Tuấn</h3>
            </div>
        </div>

    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>



            <div class="content">
                <h3>why choose us?</h3>
                <p>I too wonder why use choose us lol xD</p>
                <a href="{{ route('about') }}" class="btn">contact us</a>
            </div>

        </div>

    </section>

    <section class="reviews">

        <h1 class="title">client's reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>I don't even know why i here lol!.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Ena dza bezt don't even try to deny it.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>...</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-4.png" alt="">
                <p>Hello there?</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-5.png" alt="">
                <p>Imma not even have borrow books once but who care huh!.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-6.png" alt="">
                <p>This page is great! I think...</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

        </div>

    </section>


@endsection
