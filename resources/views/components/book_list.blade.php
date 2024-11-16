@if (count($books) > 0)
    @foreach ($books as $book)
        <a class="box" href="{!! route('book.show', ['id' => $book->book_Id]) !!}">
            <img class="image" src="{{ asset($book->book_cover_image_path) }}" alt="">
            <div class="name">{{ $book->title }}</div>
            <div class="name">Author: {{ $book->author->name }}</div>
            <div class="categories">
                @if ($book->categories->count() > 0)
                    <span class="category">Categories:</span>
                    @foreach ($book->categories as $category)
                        <span class="category">{{ $category->name }}</span>
                        @if (!$loop->last)
                            <span class="category">|</span>
                        @endif
                    @endforeach
                @else
                    <span class="category">No category</span>
                @endif
            </div>
            <div class="Language">
                @if ($book->language != null)
                    Language: {{ $book->language }}
                @else
                    Language: No information
                @endif
            </div>
            <div class="date">Released: {{ $book->released_date }}</div>
        </a>
    @endforeach
@else
    <div class="no-results">No books found</div>
@endif
