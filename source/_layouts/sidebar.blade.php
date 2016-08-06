@verbatim
@collectindex
<h3 class="text-center">Other Ways to Get Untied</h3>
<div id="ArchivesPanel">
    <collection-panel name="Archives" :collapsed-default="false">
        @foreach ($collection->getPosts('month') as $month => $posts)
            <a role="button" data-toggle="collapse" href="#collapseArchives{{ str_slug($month) }}" aria-expanded="false" aria-controls="collapseArchives{{ str_slug($month) }}"
               class="list-group-item list-group-item-info list"><span class="badge">{{ count($posts) }}</span><h4 class="list-group-item-heading">{{ $month }}</h4></a>
            <div id="collapseArchives{{ str_slug($month) }}" class="collapse archives-collapse" :class="{ 'in' : !collapsed['collapseArchives{{ str_slug($month) }}'] }">
            @foreach ($posts as $post)
                <div class="list-group-item">{{ $post['author'] }}: <a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}</a></div>
            @endforeach
            </div>
        @endforeach
    </collection-panel>
</div>
<div id="laranews">
    <rss-widget title="Laravel News" url="https://laravel-news.com/feed/"></rss-widget>
</div>
<div id="laracasts">
    <rss-widget title="Laracasts" url="https://laracasts.com/feed"></rss-widget>
</div>
<div id="TagsPanel">
    <collection-panel name="Tags">
        @foreach ($collection->getPosts('tags') as $tag => $posts)
            <a role="button" href="/posts/tagged/{{ str_slug($tag) }}" class="list-group-item list-group-item-info list">
                <span class="badge">{{ count($posts) }}</span>
                <span class="h4 list-group-item-heading">{{ $tag }}</span>
            </a>
        @endforeach
    </collection-panel>
</div>
<script type="text/javascript">
    new Vue({
        el: '#ArchivesPanel',
        data: {
            collapsed: {
                @foreach ($collection->getPosts('month') as $month => $posts)
                "collapseArchives{{ str_slug($month) }}": kwc.getIndex('archivesPanel', 'collapseArchives{{ str_slug($month) }}', true),
                @endforeach
                last: false
            }
        },
        methods: {
            hide: function(e) {
                this.collapsed[e.target.id] = true;
                kwc.setIndex('archivesPanel', e.target.id, true);
            },
            show: function(e) {
                this.collapsed[e.target.id] = false;
                kwc.setIndex('archivesPanel', e.target.id, false);
            }
        },
        ready: function() {
            $('.archives-collapse').on('show.bs.collapse', this.show).on('hide.bs.collapse', this.hide);
        }
    });
    new Vue({ el: '#laranews' });
    new Vue({ el: '#laracasts' });
    new Vue({ el: '#TagsPanel' });
</script>
@endverbatim