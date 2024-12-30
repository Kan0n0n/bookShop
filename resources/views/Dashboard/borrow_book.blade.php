<x-partials.admin_header />
<style>
    .search-input {
        border-radius: 25px;
        margin-top: 20px;
        transition: border-color 0.3s;
    }

    .search-input:focus {
        border-color: #9d3cc7;
    }
</style>

<!-- partial -->
<div class="main-panel">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> {{ session('error') }}
                        </div>
                    @endif

                    <p class="card-title mb-0">All Borrow Book</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>User ID</th>
                                    <th>User Avatar</th>
                                    <th>User Name</th>
                                    <th>Cart ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($borrowBooks) > 0)
                                    @foreach ($borrowBooks as $borrowBook)
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#cartInfoModal{{ $borrowBook->id }}">Borrow book
                                                    Info</button>

                                                <!-- The Cart Info Modal -->
                                                <div class="modal" id="cartInfoModal{{ $borrowBook->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Borrow book info</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-borderless">
                                                                        <thead>
                                                                            <div
                                                                                class="card-header bg-primary text-white">
                                                                                <h5 class="mb-0">Borrow Books
                                                                                    (Cart
                                                                                    ID: {{ $borrowBook->id }})
                                                                                </h5>
                                                                            </div>
                                                                            <tr>
                                                                                <th>Action</th>
                                                                                <th>Item ID</th>
                                                                                <th>Book ID</th>
                                                                                <th>Book Copy ID</th>
                                                                                <th>Book Image</th>
                                                                                <th>Book Title</th>
                                                                                <th>Borrow Date</th>
                                                                                <th>Due Date</th>
                                                                                <th>Return Date</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($borrowBook->borrowBooks as $borrow)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if ($borrow->status != 'returned')
                                                                                            <form
                                                                                                action="{{ route('admin.borrow.return', $borrow->id) }}"
                                                                                                method="GET">
                                                                                                @csrf
                                                                                                <button type="submit"
                                                                                                    class="btn btn-primary btn-sm">Return
                                                                                                    Book</button>
                                                                                            </form>
                                                                                        @endif
                                                                                    </td>

                                                                                    <td>{{ $borrow->id }}</td>
                                                                                    <td>{{ $borrow->book_copy->book->book_Id }}
                                                                                    </td>
                                                                                    <td>{{ $borrow->book_copy_id }}</td>
                                                                                    <td>
                                                                                        <img src="{{ asset($borrow->book_copy->book->book_cover_image_path) }}"
                                                                                            alt="book cover"
                                                                                            width="50"
                                                                                            height="50">
                                                                                    </td>
                                                                                    <td>{{ $borrow->book_copy->book->title }}
                                                                                    </td>
                                                                                    <td>{{ $borrow->borrow_date }}
                                                                                    </td>
                                                                                    <td>{{ $borrow->due_date }}</td>
                                                                                    <td>{{ $borrow->return_date }}</td>
                                                                                    @if ($borrow->status == 'returned')
                                                                                        <td class="text-success">
                                                                                            {{ $borrow->status }}</td>
                                                                                    @elseif($borrow->status == 'overdue')
                                                                                        <td class="text-danger">
                                                                                            {{ $borrow->status }}</td>
                                                                                    @elseif($borrow->status == 'borrowed')
                                                                                        <td class="text-warning">
                                                                                            {{ $borrow->status }}</td>
                                                                                    @elseif($borrow->status == 'extended')
                                                                                        <td class="text-info">
                                                                                            {{ $borrow->status }}</td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            @foreach ($borrowBook->borrowBooks as $borrow)
                                                                <div class="d-flex justify-content-end gap-2 mb-3">
                                                                    @if ($borrow->status != 'returned')
                                                                        <form
                                                                            action="{{ route('admin.borrow.returnAll', ['id' => $borrowBook->id]) }}"
                                                                            method="GET">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-success">Return All
                                                                                Books</button>
                                                                        </form>
                                                                    @break
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                        </td>

                                        <td>{{ $borrowBook->user_id }}</td>
                                        <td>
                                            <img src="{{ asset($borrowBook->user->avatar_path) }}"
                                                alt="user avatar" width="50" height="50">
                                        </td>
                                        <td>{{ $borrowBook->user->name }}</td>
                                        <td>{{ $borrowBook->id }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="14" class="text-center">No borrow books found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<x-partials.admin_footer />

<script></script>
</div>
