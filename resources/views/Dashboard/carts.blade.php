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

                    <p class="card-title mb-0">All Carts</p>

                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control col-md-4 search-input"
                            onkeyup="searchCartByUserName()" placeholder="Search for cart using username...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Cart ID</th>
                                    <th>User ID</th>
                                    <th>User Avatar</th>
                                    <th>Username</th>
                                    <th>User Email</th>
                                    <th>Cart Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($carts) > 0)
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#cartInfoModal{{ $cart->id }}">Cart
                                                    Info</button>

                                                <!-- The Cart Info Modal -->
                                                <div class="modal" id="cartInfoModal{{ $cart->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Cart info</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-borderless">
                                                                        <thead>
                                                                            @if ($cart->status == 'onActive')
                                                                                <div
                                                                                    class="card-header bg-primary text-white">
                                                                                    <h5 class="mb-0">Reserved Books
                                                                                        (Cart
                                                                                        ID: {{ $cart->id }})
                                                                                    </h5>
                                                                                </div>
                                                                            @elseif($cart->status == 'checkedOut')
                                                                                <div
                                                                                    class="card-header bg-success text-white">
                                                                                    <h5 class="mb-0">Reserved Books
                                                                                        (Cart
                                                                                        ID: {{ $cart->id }}) Checked
                                                                                        out</h5>
                                                                                </div>
                                                                            @endif
                                                                            <tr>
                                                                                <th>Item ID</th>
                                                                                <th>Book ID</th>
                                                                                <th>Book Copy ID</th>
                                                                                <th>Book Image</th>
                                                                                <th>Book Title</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($cart->items as $cartItem)
                                                                                <tr>
                                                                                    <td>{{ $cartItem->id }}</td>
                                                                                    <td>{{ $cartItem->book_copy->book->book_Id }}
                                                                                    </td>
                                                                                    <td>{{ $cartItem->book_copy_id }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <img src="{{ asset($cartItem->book_copy->book->book_cover_image_path) }}"
                                                                                            alt="book image"
                                                                                            width="50"
                                                                                            height="50">
                                                                                    </td>
                                                                                    <td>{{ $cartItem->book_copy->book->title }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex justify-content-end gap-2 mb-3">
                                                                @if ($cart->status == 'onActive')
                                                                    <form
                                                                        action="{{ route('admin.cart.checkout', ['id' => $cart->id]) }}"
                                                                        method="GET" class="me-2">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Checkout</button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('admin.cart.delete', ['id' => $cart->id]) }}"
                                                                        method="GET" class="me-2">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                @elseif($cart->status == 'checkedOut')
                                                                    <form
                                                                        action="{{ route('admin.cart.print', ['id' => $cart->id]) }}"
                                                                        method="GET" class="me-2">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Print
                                                                            Receipt</button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('admin.cart.undoCheckout', ['id' => $cart->id]) }}"
                                                                        method="GET" class="me-2">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Undo
                                                                            Checkout</button>
                                                                    </form>
                                                                @endif
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $cart->id }}</td>
                                            <td>{{ $cart->user_id }}</td>
                                            <td>
                                                <img src="{{ asset($cart->user->avatar_path) }}" alt="user avatar"
                                                    width="50" height="50">
                                            </td>
                                            <td>{{ $cart->user->name }}</td>
                                            <td>{{ $cart->user->email }}</td>
                                            <td>{{ $cart->status }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">No carts found</td>
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

    <script>
        function searchCartByUserName() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("cartTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</div>
