@extends('_layouts.master')
@decorate
@paginate(paginateByTags, collection.posts)

@section('body')
    @verbatim
        <h1>Tagged: {{ $page }}</h1>
        @foreach($items as $post)
            <h3><a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}</a></h3>
            <blockquote>
                <div class="post-excerpt">
                    {!! $post['excerpt'] !!}
                </div>
                <footer>by {{ $post['author'] }}, published {{ date('n/j/Y g:i:sA', strtotime($post['published'])) }}</footer>
            </blockquote>
        @endforeach
    @endverbatim
@endsection