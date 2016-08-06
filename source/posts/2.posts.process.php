@extends('_layouts.post')
@decorate

@collectitem({
    "title": "Beyond the Basics",
    "author": "Keith Freeman",
    "published": "2016-07-29 02:11",
    "tags": ["Pagination", "Build Decoration"]
})
@postset(excerpt,
<p>My first post pretty much sums up the basics of my approach to extending Jigsaw and building some blog/collection friendly features.  With Build Decoration and Blade re-compiling (thanks to a clever use of the <code>&commat;verbatim</code> directive), I can now create collections of pretty much anything that become available to me after the entire site is built the first time in the build process.  The magic of Build Decoration then allows me to "reprocess" the built site as many times as I want, adding decorations and features with each pass.  This is perfect for things like creating a single page index of the collection, an RSS feed of recent collection items, or a widget that presents an archive list of the collection.  But how can I create a paginated index of the collection?  Or even better, a system that will allow me to create "searchable" result sets of the collection, e.g. items matching specific tags?  Introducing: the <code>Paginator</code>, a <code>File Handler</code>, that will do just that.</p>
)

@section('post-content')
    {!! $item['excerpt'] !!}
    <p>Wait, what? A <code>File Handler</code>? The <code>Paginator</code> is really just a way of rebuilding the same file over and over again.  Each page follows the same format, you simply have different content on each page.  A collection of posts could be paginated by date newer to older or vice-versa.  Similarly, each page could contain a list of posts that were tagged with the same tag.  Using it is very simple.  Use the <code>&commat;decorate</code> directive to signal Build Decoration, and then use the <code>&commat;paginate</code> directive to supply the method of a Paginator on a Collection object and a reference to that Collection object.  (At a basic level, a Paginator would act on a Collection by grouping items together by a set of keys, or pages.)  Then you wrap your content with <code>verbatim</code> tags.  On the second pass, two variables will be passed into the view: <code>$page</code> and <code>$items</code>.  The first is the page, or key, from the Paginated Collection object, and the second is the list of items that are associated with that key.  Here's a simple example of paginating blog posts by tag:</p>
    @verbatim
    @verbatim
<pre><code class="language-php">&commat;extends('_layouts.master')
&commat;decorate
&commat;paginate(paginateByTags, collection.posts)

&commat;section('body')
    &commat;verbatim
        &lt;h1>Tagged: {{ $page }}&lt;/h1>
        &commat;foreach($items as $post)
            &lt;h3>&lt;a href="/posts/{{ $post['slug'] }}/index.html">{{ $post['title'] }}&lt;/a>&lt;/h3>
            &lt;blockquote>
                &lt;div class="post-excerpt">
                    {!! $post['excerpt'] !!}
                &lt;/div>
                &lt;footer&gt;by {{ $post['author'] }}, published {{ date('n/j/Y g:i:sA', strtotime($post['published'])) }}&lt;/footer>
            &lt;/blockquote>
        &commat;endforeach
    &commat;endverbatim
&commat;endsection</code></pre>
    @endverbatim
    @endverbatim
    <p>The <code>Paginator File Handler</code> will loop through the paginated collection, reprocessing the Blade file, inserting new data each time.  Each iteration, or page, will be saved much like a normal post, in place using a slugged version of the <code>$page</code> and with <code>/index.html</code> added to the end.</p>
@endsection