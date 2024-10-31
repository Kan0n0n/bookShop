@extends('components.layout')
@section(('title'), 'Search Books')
@section('content')
<div class="heading">
    <h3>search page</h3>
    <p> <a href="{{route('index')}}">home</a> / search </p>
</div>

<section class="search-form">
    <form action="" method="post">
        <input type="text" name="search" placeholder="search products..." class="box">
        <input type="submit" name="submit" value="search" class="btn">
    </form>
</section>

<section class="products" style="padding-top: 0;">

    <div class="box-container">
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
        <a class="box" href="#">
            <img class="image" src="images/bash_and_lucy-2.jpg" alt="">
            <div class="name">Bash and Lucy Fetch Confidence</div>
            <div class="name">Author: Lisa Cohn, Michael Cohn</div>
        </a>
    </div>

</section>
@endsection