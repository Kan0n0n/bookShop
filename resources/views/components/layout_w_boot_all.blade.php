@extends('components.layout_with_bootraps')

@section('childContent')
    @include('components.partials.header')
    @yield('content')
    @include('components.partials.footer')
@endsection
