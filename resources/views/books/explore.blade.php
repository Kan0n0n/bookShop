@extends('components.layout')
@section(('title'), 'Explore Books')
@section('content')
<div class="heading">
    <h3>our library</h3>
    <p> <a href="{{route("index")}}">home</a> / shop </p>
</div>

<section class="products">
    <h1 class="title">Explore Books</h1>

    <div class="box-container">
        <a class="box" href="#">
            <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="">
            <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            <div class="name">Author: Fujiko F. Fujio</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="">
            <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            <div class="name">Author: Fujiko F. Fujio</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="">
            <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            <div class="name">Author: Fujiko F. Fujio</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="">
            <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            <div class="name">Author: Fujiko F. Fujio</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="">
            <div class="name">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            <div class="name">Author: Fujiko F. Fujio</div>
        </a>
    </div>

</section>
@endsection