@extends('components.layout_w_boot_all')
@section('title', 'Borrow Status')
@section('content')
    <div class="container mt-5">
        <div class="heading mb-4">
            <h3>Borrow Status</h3>
            <p><a href="{{ route('index') }}">home</a> / borrow</p>
        </div>

        <!-- Reserved Books Section -->
        @if ($checkoutCart != null)
            <div class="alert alert-info mb-4 text-center" role="alert">
                <h1 class="alert-heading">Reservation Notice!</h4>
                    <h4 class="mb-0">You have a reservation with ID: <strong>{{ $checkoutCart->id }}</strong>.
                        Please show this ID to the staff when collecting your books.</h4>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Reserved Books (Cart ID: {{ $checkoutCart->id }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book Image</th>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Pickup Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkoutCart->items as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->book_copy->book->book_cover_image_path) }}"
                                                alt="Book Cover" class="img-thumbnail" style="width: 100px;">
                                        </td>
                                        <td>{{ $item->book_copy->book->title }}</td>
                                        <td>{{ $item->book_copy->book->author->name }}</td>
                                        <td>
                                            <strong>
                                                {{ \Carbon\Carbon::parse($checkoutCart->checkout_date)->format('F j, Y') }}
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">No Books Reserved</h4>
                <p class="mb-0">You haven't reserved any books yet. Visit our library to explore available books!</p>
            </div>
        @endif

        <!-- Borrowed Books Section -->
        @if ($borrowed_books && $borrowed_books->count() > 0)
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Currently Borrowed Books</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Book Image</th>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowed_books as $book)
                                    <tr>
                                        <td>
                                            @if ($book->status == 'borrowed')
                                                <a href="{{ route('borrow.extend', $book->id) }}"
                                                    class="btn btn-sm btn-warning" style="font-size: 10px">Extend</a>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset($book->book_copy->book->book_cover_image_path) }}"
                                                alt="Book Cover" class="img-thumbnail" style="width: 100px;">
                                        </td>
                                        <td>{{ $book->book_copy->book->title }}</td>
                                        <td>{{ $book->book_copy->book->author->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($book->borrow_date)->format('F j, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($book->due_date)->format('F j, Y') }}</td>
                                        <td>
                                            @if ($book->status == 'overdue')
                                                <span class="badge bg-danger text-white px-3 py-2"
                                                    style="font-size: 14px;">{{ $book->status }}</span>
                                            @elseif ($book->status == 'returned')
                                                <span class="badge bg-success text-white px-3 py-2"
                                                    style="font-size: 14px;">{{ $book->status }}</span>
                                            @elseif ($book->status == 'borrowed')
                                                <span class="badge bg-warning text-white px-3 py-2"
                                                    style="font-size: 14px;">{{ $book->status }}</span>
                                            @elseif($book->status == 'extended')
                                                <span class="badge bg-primary text-white px-3 py-2"
                                                    style="font-size: 14px;">{{ $book->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
