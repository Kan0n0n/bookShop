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

                    <p class="card-title mb-0">All Books</p>
                    <button type="button" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal"
                        data-target="#addBookModal">Add New Book</button>
                    <!-- The Add Book Modal -->
                    <div class="modal" id="addBookModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add new book</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ URL::to('/admin/book/create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Enter book title" required>
                                        <label for="isbn">ISBN:</label>
                                        <input type="text" name="isbn" id="isbn" class="form-control"
                                            placeholder="Enter book ISBN" required>
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter book description" required></textarea>
                                        <label for="pages">Pages:</label>
                                        <input type="number" name="pages" id="pages" class="form-control"
                                            placeholder="Enter book pages" min="1" required>
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            placeholder="Enter book quantity" min="1" required>
                                        <label for="released_date">Released Date:</label>
                                        <input type="date" name="released_date" id="released_date"
                                            class="form-control" required>
                                        <label for="author">Author:</label>
                                        <select name="author_id" id="author" class="form-control mb2" required>
                                            <option value="">Select author</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->author_Id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="publisher">Publisher:</label>
                                        <select name="publisher_id" id="publisher" class="form-control mb2" required>
                                            <option value="">Select publisher</option>
                                            @foreach ($publishers as $publisher)
                                                <option value="{{ $publisher->pulisher_Id }}">{{ $publisher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="language">Language:</label>
                                        <input type="text" name="language" id="language" class="form-control"
                                            placeholder="Enter book language" required>
                                        <label for="categories">Categories:</label>
                                        <div id="categories" class="row">
                                            @foreach ($categories as $category)
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="categories[]"
                                                            id="category{{ $category->category_Id }}"
                                                            value="{{ $category->category_Id }}">
                                                        <label class="form-check-label"
                                                            for="category{{ $category->category_Id }}">
                                                            {{ $category->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <label for="cover_image">Cover Image:</label>
                                        <input type="file" name="cover_image" id="cover_image" class="form-control"
                                            required>
                                        <button type="submit" class="btn btn-primary mt-2">Add Book</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control col-md-4 search-input"
                            onkeyup="searchBooks()" placeholder="Search for books...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Book ID</th>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>ISBN</th>
                                    <th>Description</th>
                                    <th>Pages</th>
                                    <th>Quantity</th>
                                    <th>Borrowed Copies</th>
                                    <th>Available Copies</th>
                                    <th>Released Date</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Languages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($books) > 0)
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editBookModal{{ $book->book_Id }}">Edit</button>

                                                <!-- The Edit Book Modal -->
                                                <div class="modal" id="editBookModal{{ $book->book_Id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update this book</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ URL::to('/admin/book/update/' . (string) $book->book_Id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="book_id"
                                                                        value="{{ $book->book_Id }}">
                                                                    <label for="title">Title:</label>
                                                                    <input type="text" name="title"
                                                                        id="title" class="form-control"
                                                                        placeholder="Enter book title"
                                                                        value="{{ $book->title }}">
                                                                    <label for="isbn">ISBN:</label>
                                                                    <input type="text" name="isbn"
                                                                        id="isbn" class="form-control"
                                                                        placeholder="Enter book ISBN"
                                                                        value="{{ $book->isbn }}">
                                                                    <label for="description">Description:</label>
                                                                    <textarea name="description" id="description" class="form-control" placeholder="Enter book description">{{ $book->description }}</textarea>
                                                                    <label for="pages">Pages:</label>
                                                                    <input type="number" name="pages"
                                                                        id="pages" class="form-control"
                                                                        placeholder="Enter book pages"
                                                                        value="{{ $book->pages }}" min="1">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input type="number" name="quantity"
                                                                        id="quantity" class="form-control"
                                                                        placeholder="Enter book quantity"
                                                                        value="{{ $book->quantity }}" min="1">
                                                                    <label for="released_date">Released Date:</label>
                                                                    <input type="date" name="released_date"
                                                                        id="released_date" class="form-control"
                                                                        value="{{ $book->released_date }}">
                                                                    <label for="author">Author:</label>
                                                                    <select name="author_id" id="author"
                                                                        class="form-control mb2">
                                                                        <option value="{{ $book->author_Id }}">
                                                                            {{ $book->author->name }}</option>
                                                                        @foreach ($authors as $author)
                                                                            @if ($author->author_Id != $book->author_Id)
                                                                                <option
                                                                                    value="{{ $author->author_Id }}">
                                                                                    {{ $author->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="publisher">Publisher:</label>
                                                                    <select name="publisher_id" id="publisher"
                                                                        class="form-control mb2">
                                                                        <option value="{{ $book->pulisher_Id }}">
                                                                            {{ $book->pulisher->name }}
                                                                        </option>
                                                                        @foreach ($publishers as $publisher)
                                                                            @if ($publisher->pulisher_Id != $book->pulisher_Id)
                                                                                <option
                                                                                    value="{{ $publisher->pulisher_Id }}">
                                                                                    {{ $publisher->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="language">Language:</label>
                                                                    <input type="text" name="language"
                                                                        id="language" class="form-control"
                                                                        placeholder="Enter book language"
                                                                        value="{{ $book->language }}">
                                                                    <label for="categories">Categories:</label>
                                                                    <div id="categories" class="row">
                                                                        @foreach ($categories as $category)
                                                                            <div class="col-md-4 col-sm-6">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="categories[]"
                                                                                        id="category{{ $category->category_Id }}"
                                                                                        value="{{ $category->category_Id }}"
                                                                                        @if (in_array($category->category_Id, $book->categories->pluck('category_Id')->toArray())) checked @endif>
                                                                                    <label class="form-check-label"
                                                                                        for="category{{ $category->category_Id }}">
                                                                                        {{ $category->name }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <label for="cover_image">Cover Image:</label>
                                                                    <img id="cover_image_preview"
                                                                        src="{{ asset($book->book_cover_image_path) }}"
                                                                        alt="Cover Image Preview"
                                                                        style="max-width: 200px; display: block; margin-bottom: 10px;">
                                                                    <input type="file" name="cover_image"
                                                                        id="cover_image" class="form-control"
                                                                        onchange="previewCoverImage(event)">
                                                                    <button type="submit"
                                                                        class="btn btn-primary mt-2">Update
                                                                        Book</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#deleteBookModal{{ $book->book_Id }}">Delete</button>

                                                <!-- The Delete Book Modal -->
                                                <div class="modal" id="deleteBookModal{{ $book->book_Id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete book</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ URL::to('/admin/book/delete/' . (string) $book->book_Id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="book_id"
                                                                        value="{{ $book->book_Id }}">
                                                                    <p>Are you sure you want to delete this book?</p>
                                                                    <button type="submit"
                                                                        class="btn btn-danger mt-2">Delete
                                                                        Book</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $book->book_Id }}</td>
                                            <td><img src="{{ asset($book->book_cover_image_path) }}" alt="image">
                                            </td>
                                            <td>{{ $book->title }}</td>
                                            @if (count($book->categories) > 0)
                                                <td>
                                                    @foreach ($book->categories as $category)
                                                        @if (!$loop->last)
                                                            {{ $category->name }} ,
                                                        @else
                                                            {{ $category->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @else
                                                <td>No category</td>
                                            @endif
                                            <td>{{ $book->isbn }}</td>
                                            <td>{{ $book->description }}</td>
                                            <td>{{ $book->pages }}</td>
                                            <td>{{ $book->quantity }}</td>
                                            <td>{{ $book->borrowed_copies }}</td>
                                            <td>{{ $book->quantity - $book->borrowed_copies }}</td>
                                            <td>{{ $book->released_date }}</td>
                                            <td>{{ $book->author->name }}</td>
                                            <td>{{ $book->pulisher->name }}</td>
                                            <td>{{ $book->language }}</td>
                                            <td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">No books found</td>
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
        function previewCoverImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('cover_image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function searchBooks() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');
            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[3];
                if (td) {
                    const textValue = td.textContent || td.innerText;
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>
</div>
