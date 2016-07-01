@extends('_layouts.master')
@decorate

@section('body')
    <h1>{{ $title }}</h1>
    <p><sub>by {{ $author }}</sub></p>
    @yield('post-content')
    <p>published {{ $published }}</p>
@endsection