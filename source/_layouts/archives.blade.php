@verbatim
    @collectindex
    <h2>Archives</h2>
    <ul>
        @foreach ($collection->getPosts('month') as $month => $posts)
            <h3>{{ $month }}</h3>
            <ul>
                @foreach ($posts as $post)
                    <li>{{ $post['author'] }}: <a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}</a></li>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endverbatim