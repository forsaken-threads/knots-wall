<h3>Get Untied!</h3>
<div id="ArchivesPanel" class="panel panel-default">
    <div class="panel-heading">
        <button @click="toggle" class="btn btn-block" href="#Archives" data-toggle="collapse" aria-expanded="false" aria-controls="Archives">
            <span class="pull-right"><i class="fa" :class="[collapsed ? 'fa-caret-square-o-down' : 'fa-caret-square-o-up']"></i></span>
            <i class="fa fa-archive"></i> Archives
        </button>
    </div>
    <div id="Archives" class="list-group panel-collapse in">
    @verbatim
        @collectindex
        <div class="panel-body">
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
<script type="text/javascript">
    new Vue({
        data: {
            collapsed: false
        },
        el: '#ArchivesPanel',
        methods: {
            toggle: function() {
                this.collapsed = ! this.collapsed;
            }
        }
    });
</script>
<div id="laranews"><rss-widget title="Laravel News" url="https://laravel-news.com/feed/"></rss-widget></div>
<script type="text/javascript">new Vue({ el: '#laranews' });</script>
<div id="laracasts"><rss-widget title="Laracasts" url="https://laracasts.com/feed"></rss-widget></div>
<script type="text/javascript">new Vue({ el: '#laracasts' });</script>