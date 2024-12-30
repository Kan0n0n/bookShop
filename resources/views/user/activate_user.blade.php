@extends('components.layout_w_boot_all')
@section('title', 'Activate User')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Library Card Activation</h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->active_status == 'inactive')
                            <div class="text-center mb-4">
                                <h5>Welcome, {{ Auth::user()->name }}!</h5>
                                <p>To start borrowing books, you need to activate your library card.</p>
                            </div>

                            <div class="alert alert-info">
                                <h5 class="alert-heading">Activation Details:</h5>
                                <p class="mb-0">Activation Fee: <strong>50,000 VND</strong></p>
                                <small>This is a one-time fee for library card activation.</small>
                            </div>

                            <div class="user-details mb-4">
                                <h6>User Information:</h6>
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Status:</strong>
                                    <span class="badge bg-warning">Inactive</span>
                                </p>
                            </div>

                            <form action="{{ route('user.process.payment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="50000">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-credit-card me-2"></i>
                                        Pay with VNPay
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="text-center mb-4">
                                <h5>Welcome, {{ Auth::user()->name }}!</h5>
                                <p>Your library card is already activated.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5"></div>
@endsection
