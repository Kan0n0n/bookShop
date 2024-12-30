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

                    <p class="card-title mb-0">All Users</p>
                    <button type="button" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal"
                        data-target="#addUserModal">Add New User</button>
                    <!-- The Add Book Modal -->
                    <div class="modal" id="addUserModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add new user</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ URL::to('/admin/user/create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            required>
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required>
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required>
                                        <label for="address">Address:</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            required>
                                        <label for="phone">Phone:</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            required>
                                        <label for="gerne">Gerne:</label>
                                        <select name="gerne" id="gerne" class="form-control" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label for="date_of_birth">Date of Birth:</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            class="form-control" required>
                                        <label for="role">Role:</label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <label for="avatar">Avatar:</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control"
                                            required>
                                        <button type="submit" class="btn btn-primary mt-2">Add User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control col-md-4 search-input"
                            onkeyup="searchUser()" placeholder="Search for user...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Avatar</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Gerne</th>
                                    <th>Date of Birth</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <button type="button"
                                                    class="btn {{ $user->status ? 'btn-danger' : 'btn-primary' }} btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#deleteBookModal{{ $user->id }}">
                                                    @if ($user->status == true)
                                                        Block
                                                    @else
                                                        Unblock
                                                    @endif
                                                </button>

                                                <!-- The Delete Book Modal -->
                                                <div class="modal" id="deleteBookModal{{ $user->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Block User</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ URL::to('/admin/user/delete/' . (string) $user->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $user->id }}">
                                                                    <p>Are you sure you want to block this user?
                                                                    </p>
                                                                    <button type="submit"
                                                                        class="btn btn-danger mt-2">Block
                                                                        User</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><img src="{{ asset($user->avatar_path) }}" alt="user avatar"
                                                    style="width: 50px; height: 50px;"></td>

                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gerne }}</td>
                                            <td>{{ $user->date_of_birth }}</td>
                                            <td>
                                                @if ($user->role == 1)
                                                    Admin
                                                @else
                                                    User
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">No user found</td>
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
        function searchUser() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementsByClassName("table")[0];
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
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
