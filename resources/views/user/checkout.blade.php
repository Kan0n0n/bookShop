@extends('components.layout_w_boot_all')
@section('title', 'Checkout')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Checkout</h2>
        <div class="row">
            <!-- Left Column - Book Information -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($cart->items as $item)
                            <div class="d-flex mb-3 align-items-center">
                                <img src="{{ asset($item->book_copy->book->book_cover_image_path) }}" alt="Book Cover"
                                    class="img-thumbnail" style="width: 100px;">
                                <div class="ms-3 flex-grow-1">
                                    <h5 class="mb-1">{{ $item->book_copy->book->title }}</h5>
                                    <p class="mb-1">Author: {{ $item->book_copy->book->author->name }}</p>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Total Items</h5>
                            <h5 class="mb-0">{{ $cart->items->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - User Information -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">User Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process', ['id' => $cart->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <div class="mb-3">
                                <label class="form-label" style="color: red">Important Notice</label>
                                <p style="color: red">Please make sure your information is correct
                                    before proceeding
                                    with the checkout.<br>Please get your books in time!!! Your cart will be cancle if you
                                    late to pick up more than 2 days<br>Please return in time to avoid late fee cost<br>
                                    Thank you for your cooperation</p>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pickup Date</label>
                                <div class="form-check">
                                    <input class="form-check-input pickup-date" type="radio" name="pickup_date"
                                        value="{{ Carbon\Carbon::now()->addDays(2)->format('Y-m-d') }}" id="pickup2"
                                        required>
                                    <label class="form-check-label" for="pickup2">
                                        {{ Carbon\Carbon::now()->addDays(2)->format('l, F j, Y') }}
                                        (2 days from now)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input pickup-date" type="radio" name="pickup_date"
                                        value="{{ Carbon\Carbon::now()->addDays(3)->format('Y-m-d') }}" id="pickup3">
                                    <label class="form-check-label" for="pickup3">
                                        {{ Carbon\Carbon::now()->addDays(3)->format('l, F j, Y') }}
                                        (3 days from now)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input pickup-date" type="radio" name="pickup_date"
                                        value="{{ Carbon\Carbon::now()->addDays(4)->format('Y-m-d') }}" id="pickup4">
                                    <label class="form-check-label" for="pickup4">
                                        {{ Carbon\Carbon::now()->addDays(4)->format('l, F j, Y') }}
                                        (4 days from now)
                                    </label>
                                </div>
                                @error('pickup_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Return Date</label>
                                <input type="text" class="form-control" id="return_date" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->address }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Confirm Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pickupInputs = document.querySelectorAll('.pickup-date');

            pickupInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        const pickupDate = new Date(this.value);
                        const returnDate = new Date(pickupDate);
                        returnDate.setDate(returnDate.getDate() + 7);

                        const formattedReturn = returnDate.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        document.getElementById('return_date').value = formattedReturn;
                    }
                });
            });

            // Set initial return date if a pickup date is pre-selected
            const checkedPickup = document.querySelector('.pickup-date:checked');
            if (checkedPickup) {
                checkedPickup.dispatchEvent(new Event('change'));
            }
        });
    </script>

@endsection
