@extends('_layouts.master')
@decorate
@section('body')
    @verbatim
        @collectindex
        <ul>
        @foreach ($collection->getPosts()->take(10) as $post)
            <li>{{ $post['author'] }}: <a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}</a></li>
        @endforeach
        </ul>
    @endverbatim
@endsection