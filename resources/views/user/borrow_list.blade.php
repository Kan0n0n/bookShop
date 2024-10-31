@extends('components.layout')

@section('title', 'Borrow List')

@section('content')
<div class="heading">
    <h3>borrow list</h3>
    <p> <a href="{{route("index")}}">home</a> / borrow list </p>
</div>

<section class="borrow-list">
    <h3>Borrow List</h3>

    <div class="box-container">
        <table class="tb">
            <thead class="tb-head">
                <tr>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Borrow date</th>
                    <th>Due date</th>
                </tr>
            </thead>
            <tbody class="tb-body">
                @foreach ($books as $key => $book)
                <tr class="tb-body-child">
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['author'] }}</td>
                    <td>{{ $book['borrowed at'] }}</td>
                    <td>{{ $book['returned at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection