@extends('_layouts.master')
@decorate

@section('body')
    <h1>{{ $title }}</h1>
    <p><small>by {{ $author }}, published {{ date('n/j/Y g:iA', strtotime($published)) }}</small></p>
    <div class="post-content">
        @yield('post-content')
    </div>
    <hr />
@endsection