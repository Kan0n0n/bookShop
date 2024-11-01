@extends('components.layout')
@section(('title'), 'Book')
@section('content')
<div class="heading">
    <h3>book</h3>
    <p> <a href="{{route("index")}}">home</a> / <a href="{{route("book.create")}}">explore books</a> / book </p>
</div>

<section class="book">

    <div class="book-info-container">
        <div class="book-cover">
            <img src="{{asset('images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg')}}"
                alt="Book Cover">
        </div>
    </div>

    <div class="book-details">
        <div class="book-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>

        <div class="book-rating">
            <span class="star-rating">
                *****
            </span> (0)
        </div>

        <div class="book-availability">
            <span class="available-copies">Available Copies: 5</span>
        </div>

        <div class="due-date">
            <span class="due-date-label">Due Date:</span>
            <span class="due-date-value">Thứ tư - 30/10</span>
        </div>

        <div class="author">
            <span class="author-label">Author:</span>
            <span class="author-value">Fujiko F. Fujio</span>
        </div>

        <div class="borrow-button">
            <button>Borrow</button>
        </div>
    </div>
</section>

<div class="horizontal-line"></div>

<section class="book-details-info">
    <h3>Book Details</h3>
    <div class="book-details-info-container">
        <p> <span class="label">Publisher:</span> <span class="value">Kim Đồng</span> </p>
        <p> <span class="label">Publication Date:</span> <span class="value">2019</span> </p>
        <p> <span class="label">ISBN:</span> <span class="value">9786042080000</span> </p>
        <p> <span class="label">Language:</span> <span class="value">Vietnamese</span> </p>
        <p> <span class="label">Pages:</span> <span class="value">192</span> </p>
    </div>
    <div class="vertical-line"></div>
    <div class="book-details-info-description">
        <h3>Description</h3>
        <p>Đây là cuốn sách thứ 2 trong bộ tiểu thuyết Doraemon. Câu chuyện kể về cuộc phiêu lưu của Nobita và các bạn
            trong chuyến đi tìm kiếm bản giao hưởng địa cầu. </p>
    </div>
</section>

<div class="horizontal-line"></div>

<section class="book-recommendation">
    <h3>Based On Your Choice</h3>
    <div class="book-recommendation-container">
        <a href="#" class="book-recommendation-item">
            <div class="book-recommendation-item-cover">
                <img src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="Book Cover">
            </div>
            <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
        </a>
        <a href="#" class="book-recommendation-item">
            <div class="book-recommendation-item-cover">
                <img src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="Book Cover">
            </div>
            <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
        </a>
        <a href="#" class="book-recommendation-item">
            <div class="book-recommendation-item-cover">
                <img src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="Book Cover">
            </div>
            <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
        </a>
        <a href="#" class="book-recommendation-item">
            <div class="book-recommendation-item-cover">
                <img src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="Book Cover">
            </div>
            <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
        </a>
        <a href="#" class="book-recommendation-item">
            <div class="book-recommendation-item-cover">
                <img src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg" alt="Book Cover">
            </div>
            <div class="book-recommendation-item-title">Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</div>
        </a>
    </div>
</section>

<div class="horizontal-line"></div>
<section class="review">
    <div class="write-review">
        <h3>Write a Review</h3>
        <div class="write-review-container">
            <div class="write-review-container-rating">
                <span class="star-rating">
                    *****
                </span>
            </div>
            <div class="write-review-container-textarea">
                <textarea name="review" id="review" cols="30" rows="10" placeholder="Write your review here"></textarea>
            </div>
            <div class="write-review-container-button">
                <button>Submit</button>
            </div>
        </div>
    </div>

    <div class="vertical-line"></div>

    <div class="member-review">
        <h3>Reviews</h3>
        <div class="review-container">
            <div class="review-item">
                <div class="review-item-header">
                    <div class="review-item-header-avatar">
                        <img src="images/avatar.jpg" alt="Avatar">
                    </div>
                    <div class="review-item-header-info">
                        <div class="review-item-header-info-name">Nguyễn Văn A</div>
                        <div class="review-item-header-info-rating">
                            <span class="star-rating">
                                *****
                            </span>
                        </div>
                    </div>
                </div>
                <div class="review-datetime">
                    <span class="review-datetime-value">Thứ tư - 30/10</span>
                </div>
                <div class="review-item-content">
                    <p>Đây là cuốn sách rất hay, mình rất thích đọc. </p>
                </div>
            </div>
            <div class="review-item">
                <div class="review-item-header">
                    <div class="review-item-header-avatar">
                        <img src="images/avatar.jpg" alt="Avatar">
                    </div>
                    <div class="review-item-header-info">
                        <div class="review-item-header-info-name">Nguyễn Văn B</div>
                        <div class="review-item-header-info-rating">
                            <span class="star-rating">
                                *****
                            </span>
                        </div>
                    </div>
                </div>
                <div class="review-datetime">
                    <span class="review-datetime-value">Thứ tư - 30/10</span>
                </div>
                <div class="review-item-content">
                    <p>Đây là cuốn sách rất hay, mình rất thích đọc. </p>
                </div>
            </div>
            <div class="review-item">
                <div class="review-item-header">
                    <div class="review-item-header-avatar">
                        <img src="images/avatar.jpg" alt="Avatar">
                    </div>
                    <div class="review-item-header-info">
                        <div class="review-item-header-info-name">Nguyễn Văn C</div>
                        <div class="review-item-header-info-rating">
                            <span class="star-rating">
                                *****
                            </span>
                        </div>
                    </div>
                </div>
                <div class="review-datetime">
                    <span class="review-datetime-value">Thứ tư - 30/10</span>
                </div>
                <div class="review-item-content">
                    <p>Đây là cuốn sách rất hay, mình rất thích đọc. </p>
                </div>
            </div>
        </div>
</section>
@endsection