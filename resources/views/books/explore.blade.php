@extends('components.layout_w_boot_all')
@section('title', 'Explore Books')
@section('content')
    <div class="heading">
        <h3>our library</h3>
        <p> <a href="{{ route('index') }}">home</a> / shop </p>
    </div>

    <section class="products">
        <h1 class="title">Explore Books</h1>

        <div class="filter-container">
            <div class="search-section">
                <input type="text" id="searchInput" placeholder="Search for books...">

                <div class="category-filter">
                    <h4>Categories</h4>
                    <div class="checkbox-group">
                        @foreach ($categories as $category)
                            <label class="checkbox-container">
                                <input type="checkbox" name="category" value="{{ $category->category_Id }}">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <select id="sortBy">
                    <option value="">Sort By</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>

                <select id="perPage">
                    {{-- <option value="6">6 per page</option>
                    <option value="15" selected>15 per page</option>
                    <option value="30">30 per page</option>
                    <option value="60">60 per page</option> --}}
                    @if (isset($perPage))
                        <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>6 per page</option>
                        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 per page</option>
                        <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30 per page</option>
                        <option value="60" {{ $perPage == 60 ? 'selected' : '' }}>60 per page</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="box-container">
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
        </div>

        <div class="pagination d-flex justify-content-center mt-4">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </section>
@endsection
