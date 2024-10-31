@extends('components.layout_clean')


@section('childContent')
@include('components.partials.header')
@yield('content')
@include('components.partials.footer')
@endsection