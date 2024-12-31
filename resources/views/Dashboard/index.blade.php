<x-partials.admin_header />
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="{{ URL::asset('Dashboard/images/dashboard/people.svg') }}" alt="people">
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Books</p>
                                <p class="fs-30 mb-2">{{ $totalBooks }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Users</p>
                                <p class="fs-30 mb-2">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Active Borrow</p>
                                <p class="fs-30 mb-2">{{ $activeBorrows }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Revenue</p>
                                <p class="fs-30 mb-2">{{ $totalRevenue }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Top Borrowers</p>
                        </div>
                        <p class="font-weight-500">This chart show top borrows with column is the borrow amount</p>
                        <canvas id="borrowersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Popular Books</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Book Image</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Borrow Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($popularBooks as $book)
                                        <tr>
                                            <td>
                                                <img src="{{ URL::asset($book['book_image']) }}" alt="book">
                                            </td>
                                            <td>{{ $book['title'] }}</td>
                                            <td>{{ $book['author'] }}</td>
                                            <td>{{ $book['borrow_count'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Recent Activities</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>User Avatar</th>
                                        <th>Name</th>
                                        <th>Book Image</th>
                                        <th>Book Title</th>
                                        <th>Borrow Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentActivities as $activity)
                                        <tr>
                                            <td>
                                                <img src="{{ URL::asset($activity->user->avatar_path) }}"
                                                    alt="user">
                                            </td>
                                            <td>{{ $activity->user->name }}</td>
                                            <td>
                                                <img src="{{ URL::asset($activity->book->book_cover_image_path) }}"
                                                    alt="book">
                                            </td>
                                            <td>{{ $activity->book->title }}</td>
                                            <td>{{ $activity['borrow_date'] }}</td>
                                            <td>{{ $activity['return_date'] }}</td>
                                            <td>
                                                @if ($activity['status'] == 'borrowed')
                                                    <label
                                                        class="badge badge-warning">{{ $activity['status'] }}</label>
                                                @else
                                                    <label
                                                        class="badge badge-success">{{ $activity['status'] }}</label>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('borrowersChart').getContext('2d');
            var borrowersData = @json($topBorrowers);
            console.log(borrowersData);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: borrowersData.map(item => item.user.name),
                    datasets: [{
                        label: 'Borrow Amount',
                        data: borrowersData.map(item => item.total_borrows),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Top Borrowers Statistics'
                        }
                    }
                }
            });
        });
    </script>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <x-partials.admin_footer />
    <!-- partial -->
</div>
