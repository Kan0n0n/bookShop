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

                    <p class="card-title mb-0">All Authors</p>
                    <button type="button" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal"
                        data-target="#addAuthorModal">Add New Author</button>
                    <!-- The Add Book Modal -->
                    <div class="modal" id="addAuthorModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add new author</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ URL::to('/admin/author/create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            required>
                                        <button type="submit" class="btn btn-primary mt-2">Add Author</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control col-md-4 search-input"
                            onkeyup="searchAuthor()" placeholder="Search for author...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Author ID</th>
                                    <th>Author Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($authors) > 0)
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#editBookModal{{ $author->author_Id }}">Edit</button>

                                                <!-- The Edit Book Modal -->
                                                <div class="modal" id="editBookModal{{ $author->author_Id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update this author</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ URL::to('/admin/author/update/' . (string) $author->author_Id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="author_id"
                                                                        value="{{ $author->author_Id }}">
                                                                    <label for="name">Name:</label>
                                                                    <input type="text" name="name" id="name"
                                                                        class="form-control" value="{{ $author->name }}"
                                                                        required>
                                                                    <button type="submit"
                                                                        class="btn btn-primary mt-2">Update
                                                                        Author</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteBookModal{{ $author->author_Id }}">Delete</button>

                                                <!-- The Delete Book Modal -->
                                                <div class="modal" id="deleteBookModal{{ $author->author_Id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete Author</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ URL::to('/admin/author/delete/' . (string) $author->author_Id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="author_id"
                                                                        value="{{ $author->author_Id }}">
                                                                    <p>Are you sure you want to delete this author?</p>
                                                                    <button type="submit"
                                                                        class="btn btn-danger mt-2">Delete
                                                                        Author</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $author->author_Id }}</td>
                                            <td>{{ $author->name }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">No auhtors found</td>
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
        function searchAuthor() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementsByTagName("table")[0];
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
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
