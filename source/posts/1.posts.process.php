@extends('_layouts.post')
@decorate

@collectitem({
    "title": "This is the first post.",
    "author": "Keith Freeman",
    "published": "2016-06-27 19:34:30"
})

@section('post-content')
<pre>
Here is some content.
This is a really boring post.
I don't think anyone will come back to this blog.
</pre>
@endsection