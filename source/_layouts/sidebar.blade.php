<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-archive"></i> Archives</div>
    <div class="panel-body">
@verbatim
    @collectindex
    <div class="list-group">
        @foreach ($collection->getPosts('month') as $month => $posts)
            <a role="button" data-toggle="collapse" href="#collapseArchives{{ str_slug($month) }}" aria-expanded="false" aria-controls="collapseArchives{{ str_slug($month) }}"
               class="list-group-item list-group-item-info list"><span class="badge">{{ count($posts) }}</span><h4 class="list-group-item-heading">{{ $month }}</h4></a>
            <div id="collapseArchives{{ str_slug($month) }}" class="collapse">
            @foreach ($posts as $post)
                <a class="list-group-item" href="/posts/{{ $post['slug'] }}/index.html">{{ $post['author'] }}: {{ $post['title'] }}</a>
            @endforeach
            </div>
        @endforeach
    </div>
@endverbatim
    </div>
</div>
<div id="laranews"><rss-widget url="https://laravel-news.com/feed/"></rss-widget></div>
<script type="text/javascript">new Vue({ el: '#laranews' });</script>
<div id="laracasts"><rss-widget url="https://laracasts.com/feed"></rss-widget></div>
<script type="text/javascript">new Vue({ el: '#laracasts' });</script>