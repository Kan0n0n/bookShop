@extends('components.layout')
@section('title', 'Home')
@section('content')
    <section class="home">

        <div class="content">
            <h3>Welcome you to our library.</h3>
            <p>"The only thing you absolutely have to know, is the location of the library." – Albert Einstein.</p>
            <a href="{{ route('about') }}" class="white-btn">Discover More</a>
        </div>

    </section>

    <section class="products">

        <h1 class="title">New Books</h1>
        @if (count($books) > 0)
            <div class="box-container">
                @foreach ($books as $book)
                    <a class="box" href="{!! route('book.show', ['id' => $book->book_Id]) !!}">
                        <img class="image" src="{{ asset($book->book_cover_image_path) }}" alt="">
                        <div class="name">{{ $book->title }}</div>
                        <div class="name">Author: {{ $book->author->name }}</div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="box-container">
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
                <a class="box" href="#">
                    <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                        alt="">
                    <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
                    <div class="name">Author: Fujiko F. Fujio</div>
                </a>
            </div>

            <div class="load-more" style="margin-top: 2rem; text-align:center">
                <a href="{{ route('book.create') }}" class="option-btn">load more</a>
            </div>
        @endif
        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="{{ route('book.create') }}" class="option-btn">load more</a>
        </div>
    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>about us</h3>
                <p>We got no names what u even try to look for really...</p>
                <a href="{{ route('about') }}" class="btn">read more</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <a href="{{ route('contact') }}" class="white-btn">contact us</a>
        </div>

    </section>
@endsection
