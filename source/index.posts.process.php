@extends('_layouts.master')
@decorate
@section('body')
    <div id="TwoQuickNotesToggle">
        <a role="button" @click="toggle" class="text-knotswall-dark" href="#TwoQuickNotes" data-toggle="collapse" aria-expanded="false" aria-controls="TwoQuickNotes">
            <i class="fa" :class="[collapsed ? 'fa-caret-down' : 'fa-caret-up']"></i>
            Two Quick Notes
        </a>
        <ol id="TwoQuickNotes" v-on:show.bs.collaps="toggle()" v-on:hide.bs.collapse="toggle()" class="small collapse" :class="{ 'in': !start }">
            <li>This blog will eventually be a place where I share the ways I've resolved little problems, or knots, during my time programming in PHP and various other environments. For now, it's a kind of a <code>behind-the-scenes</code> look at how I developed a fork of <a href="https://github.com/tightenco/jigsaw/">Jigsaw</a> that allowed me to create a blog in the first place.  What better way for a programmer to create a blog than to bootstrap it up and document it along the way?</li>
            <li>Like many programmers my age, I grew up self taught writing Basic programs before graduating to Pascal.  Eventually, I got into PHP back in version 4 but never really got out of that Jurassic age until two years ago when a new job, and a great new friend, opened up my dinosaur brain to the world of <a href="http://laravel.com">Laravel</a>.  The elegance, brilliance, and simplicity of that framework encouraged me to shed my procedural scales and expand my staid horizons.  The experience has brought new vigor and interest to my career and my love for programming.  <code>The Knots Wall</code> is a coded ode to Laravel and its creator, Taylor Otwell.  Look closely at the colored logo above and maybe you'll spot it.</li>
        </ol>
    </div>
    <script type="text/javascript">
        new Vue({
            compiled: function() {
                if (kwc.get('twoQuickNotesViewed', 0) > 3) {
                    kwc.set('twoQuickNotesCollapsed', true);
                }
            },
            data: {
                collapsed: kwc.get('twoQuickNotesCollapsed', false),
                start: kwc.get('twoQuickNotesCollapsed', false),
            },
            destroyed: function() {
                console.log('destroyed');
            },
            el: '#TwoQuickNotesToggle',
            methods: {
                toggle: function() {
                    kwc.toggle('twoQuickNotesCollapsed');
                    if (!kwc.get('twoQuickNotesCollapsed')) {
                        kwc.set('twoQuickNotesViewed', 0);
                    }
                    this.collapsed = ! this.collapsed;
                }
            },
            ready: function() {
                if (!this.collapsed) {
                    kwc.increment('twoQuickNotesViewed', 3);
                }
            }
        });
    </script>
    @verbatim
        @collectindex
        @foreach ($collection->getPosts()->take(5) as $post)
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