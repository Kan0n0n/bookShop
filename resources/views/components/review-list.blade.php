<div id="reviews-container" class="reviews-container">
    @if ($reviews->count() > 0)
        @foreach ($reviews as $review)
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
                    <span class="review-datetime-value">{{ $review->created_at->format('l - d/m') }}</span>
                </div>
                <div class="review-item-content">
                    <p>{{ $review->review }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p class="no-results">No reviews</p>
    @endif
</div>
<div class="pagination d-flex justify-content-center mt-4" id="pagination-links">
    {{ $reviews->appends(request()->query())->links() }}
</div>
