@extends('components.layout')
@section('title', 'Book')
@section('content')
    <div class="heading">
        <h3>book</h3>
        <p> <a href="{{ route('index') }}">home</a> / <a href="{{ route('book.create') }}">explore books</a> / book </p>
    </div>

    <section class="book">

        <div class="book-info-container">
            <div class="book-cover">
                @if ($book->book_cover_image_path)
                    <img src="{{ asset($book->book_cover_image_path) }}" alt="Book Cover">
                @else
                    <img src="{{ asset('images/no_img.jpg') }}" alt="Book Cover">
                @endif
            </div>
        </div>

        <div class="book-details">
            <div class="book-title">{{ $book->title }}</div>
            {{-- <div class="book-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div> --}}

            <div class="book-availability">
                @if ($book->quantity - $book->borrowed_copies > 0)
                    <span class="available-copies">Available Copies: {{ $book->quantity - $book->borrowed_copies }}</span>
                @else
                    <span class="available-copies">None Available Copies</span>
                @endif
            </div>

            {{-- <div class="due-date">
                <span class="due-date-label">Due Date:</span>
                <span class="due-date-value">{{ $dueDate }}</span>
            </div> --}}

            <div class="author">
                <span class="author-label">Author:</span>
                <span class="author-value">{{ $book->author->name }}</span>
                {{-- <span class="author-value">Fujiko F. Fujio</span> --}}
            </div>

            <div class="borrow-button">
                @if (!Auth::check())
                    <h4>Please <a href="{{ route('login') }}">login</a> to borrow this book</h4>
                @elseif (Auth::user()->active_status == 'inactive')
                    <h4>Please <a href="{{ route('activate', ['id' => Auth::user()->id]) }}">activate</a> your account to
                        borrow this book</h4>
                @else
                    <form action="{{ route('cart.add') }}" method="post" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="book_id" value="{{ $book->book_Id }}">
                        <input type="hidden" name="book_title" value="{{ $book->title }}">
                        <input type="hidden" name="book_author" value="{{ $book->author->name }}">
                        <input type="hidden" name="book_cover" value="{{ $book->book_cover_image_path }}">
                        <input type="hidden" name="due_date" value="{{ $dueDate }}">
                        <button class="add-to-cart-btn" data-book-id="{!! $book->book_Id !!}"
                            data-available="{!! $book->quantity - $book->borrowed_copies !!}" {!! $book->quantity - $book->borrowed_copies <= 0 ? 'disabled' : '' !!} type="{!! $book->quantity - $book->borrowed_copies > 0 ? 'submit' : '' !!}">
                            <i class="fas fa-cart-plus"></i>
                            {!! $book->quantity - $book->borrowed_copies > 0 ? 'Add to cart' : 'Out of stock' !!}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </section>

    <div class="horizontal-line"></div>

    <section class="book-details-info">
        <h3>Book Details</h3>
        <div class="book-details-info-container">
            {{-- <p> <span class="label">Publisher:</span> <span class="value">Kim Đồng</span> </p>
            <p> <span class="label">Publication Date:</span> <span class="value">2019</span> </p>
            <p> <span class="label">ISBN:</span> <span class="value">9786042080000</span> </p>
            <p> <span class="label">Language:</span> <span class="value">Vietnamese</span> </p>
            <p> <span class="label">Pages:</span> <span class="value">192</span> </p> --}}
            <p> <span class="label">Publisher:</span> <span class="value">{{ $book->pulisher->name }}</span> </p>
            <p> <span class="label">Publication Date:</span> <span
                    class="value">{{ $book->published_date->format('d-m-Y') }}</span> </p>
            <p> <span class="label">ISBN:</span> <span class="value">{{ $book->isbn }}</span> </p>
            @if ($book->categories->count() > 0)
                <p> <span class="label">Categories:</span>
                    @foreach ($book->categories as $category)
                        <span class="value">{{ $category->name }}</span>
                        @if (!$loop->last)
                            <span class="value">|</span>
                        @endif
                    @endforeach
                </p>
            @endif
            @if ($language)
                <p> <span class="label">Language:</span> <span class="value">{{ $language }}</span> </p>
            @endif
            @if ($book->pages > 0)
                <p> <span class="label">Pages:</span> <span class="value">{{ $book->pages }}</span> </p>
            @else
                <p> <span class="label">Pages:</span> <span class="value">No information</span> </p>
            @endif
        </div>
        <div class="vertical-line"></div>
        <div class="book-details-info-description">
            <h3>Description</h3>
            {{-- <p>Đây là cuốn sách thứ 2 trong bộ tiểu thuyết Doraemon. Câu chuyện kể về cuộc phiêu lưu của Nobita và các bạn
                trong chuyến đi tìm kiếm bản giao hưởng địa cầu. </p> --}}
            @if ($book->description)
                <p>{{ $book->description }}</p>
            @else
                <p>No description</p>
            @endif
        </div>
    </section>

    <div class="horizontal-line"></div>

    <section class="book-recommendation">
        <h3>Based On Your Choice</h3>
        <div class="book-recommendation-container">
            @if ($bookRecommendations->count() > 0)
                @foreach ($bookRecommendations as $bookRecommendation)
                    <a href="{!! route('book.show', ['id' => $bookRecommendation->book_Id]) !!}" class="book-recommendation-item">
                        <div class="book-recommendation-item-cover">
                            @if ($bookRecommendation->book_cover_image_path)
                                <img src="{{ asset($bookRecommendation->book_cover_image_path) }}" alt="Book Cover">
                            @else
                                <img src="{{ asset('images/no_img.jpg') }}" alt="Book Cover">
                            @endif
                        </div>
                        <div class="book-recommendation-item-title">{{ $bookRecommendation->title }}</div>
                    </a>
                @endforeach
            @else
                <p>No recommendation</p>
            @endif
            {{-- <a href="#" class="book-recommendation-item">
                <div class="book-recommendation-item-cover">
                    <img src="{{ asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') }}"
                        alt="Book Cover">
                </div>
                <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            </a>
            <a href="#" class="book-recommendation-item">
                <div class="book-recommendation-item-cover">
                    <img src="{{ asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') }}"
                        alt="Book Cover">
                </div>
                <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            </a>
            <a href="#" class="book-recommendation-item">
                <div class="book-recommendation-item-cover">
                    <img src="{{ asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') }}"
                        alt="Book Cover">
                </div>
                <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            </a>
            <a href="#" class="book-recommendation-item">
                <div class="book-recommendation-item-cover">
                    <img src="{{ asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') }}"
                        alt="Book Cover">
                </div>
                <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            </a>
            <a href="#" class="book-recommendation-item">
                <div class="book-recommendation-item-cover">
                    <img src="{{ asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') }}"
                        alt="Book Cover">
                </div>
                <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
            </a> --}}
        </div>
    </section>

    <div class="horizontal-line"></div>
    <section class="review">
        <div class="write-review">
            <h3>Write a Review</h3>
            @if (Auth::check())
                @if ($user_review != null)
                    <form action="{{ route('review.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="review_id" value="{{ $user_review->review_Id }}">
                        <div class="write-review-container">
                            <div class="write-review-container-rating">
                                <div class="star-rating">
                                    <input type="radio" name="rating" id="rating1" value="1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating2" value="2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating3" value="3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating4" value="4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating5" value="5" checked>
                                    <label for="rating5" class="fa fa-star"></label>
                                </div>
                            </div>
                            <div class="write-review-container-textarea">
                                <textarea name="review" id="review" cols="30" rows="10" placeholder="Write your review here"></textarea>
                            </div>
                            <div class="write-review-container-button">
                                <input type="submit" name="update" value="Update" class="btn">
                            </div>
                            <input type="hidden" name="book_id" value="{{ $book->book_Id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </div>
                    </form>
                @else
                    <form action="{{ route('review.create') }}" method="post">
                        @csrf
                        <div class="write-review-container">
                            <div class="write-review-container-rating">
                                <div class="star-rating">
                                    <input type="radio" name="rating" id="rating1" value="1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating2" value="2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating3" value="3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating4" value="4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating5" value="5" checked>
                                    <label for="rating5" class="fa fa-star"></label>
                                </div>
                            </div>
                            <div class="write-review-container-textarea">
                                <textarea name="review" id="review" cols="30" rows="10" placeholder="Write your review here"></textarea>
                            </div>
                            <div class="write-review-container-button">
                                <input type="submit" name="submit" value="Submit" class="btn">
                            </div>
                            <input type="hidden" name="book_id" value="{{ $book->book_Id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </div>
                    </form>
                @endif
            @else
                <p>Please <a href="{{ route('login') }}">login</a> to write a review</p>
            @endif

        </div>

        <div class="vertical-line"></div>

        <div class="member-review">
            <h3>Reviews</h3>
            <div class="review-container" id="review-container">
                @if ($user_review != null)
                    <h4>Your Review</h4>
                    <div class="review-item">
                        <div class="review-item-header">
                            <div class="review-item-header-avatar">
                                <img src="{{ asset($user_review->user->avatar_path) }}" alt="Avatar">
                            </div>
                            <div class="review-item-header-info">
                                <div class="review-item-header-info-name">{{ $user_review->user->name }}</div>
                                <div class="review-item-header-info-rating">
                                    <div class="star-rating" style="color: #ffe400">
                                        @for ($i = 0; $i < $user_review->rating; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-datetime">
                            <span class="review-datetime-value">{{ $user_review->created_at->format('l - d/m') }}</span>
                        </div>
                        <div class="review-item-content">
                            <p>{{ $user_review->review }}</p>
                        </div>
                    </div>
                @endif
                @if ($reviews->count() > 0)
                    @foreach ($reviews as $review)
                        @if ($review->user->id != Auth::user()->id)
                            <div class="review-item">
                                <div class="review-item-header">
                                    <div class="review-item-header-avatar">
                                        <img src="{{ asset($review->user->avatar_path) }}" alt="Avatar">
                                    </div>
                                    <div class="review-item-header-info">
                                        <div class="review-item-header-info-name">{{ $review->user->name }}</div>
                                        <div class="review-item-header-info-rating">
                                            <div class="star-rating" style="color: #ffe400">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-datetime">
                                    <span
                                        class="review-datetime-value">{{ $review->created_at->format('l - d/m') }}</span>
                                </div>
                                <div class="review-item-content">
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="no-results">No reviews</p>
                @endif
                <div class="pagination d-flex justify-content-center mt-4" id="pagination-links">
                    {{ $reviews->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#review-container').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var bookId = {{ $book->book_Id }};
                fetch_data(page, bookId);
            });

            function fetch_data(page, bookId) {
                $('#review-container').addClass('fade-out');
                $.ajax({
                    url: '/book/' + bookId + '?page=' + page,
                    success: function(data) {
                        $('#review-container').html(data);
                        $('#review-container').removeClass('fade-out').addClass('fade-in');
                        setTimeout(function() {
                            $('#review-container').removeClass('fade-in');
                        }, 500);
                    }
                });
            }
        })
    </script>

@endsection
