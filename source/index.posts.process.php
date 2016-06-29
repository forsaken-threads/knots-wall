@extends('_layouts.master')

@section('body')
    @verbatim
        @collectindex
        <ul>
        @foreach ($collection->getPosts() as $post)
            <li>{{ $post['author'] }}: <a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}</a></li>
        @endforeach
        </ul>
    @endverbatim
@endsection