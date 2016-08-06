@extends('_layouts.post')
@decorate

@collectitem({
"title": "Let's rewind a little",
"author": "Keith Freeman",
"published": "2016-08-06 12:05",
"tags": ["Pagination", "Build Decoration"]
})
@postset(excerpt,
<p>I want to go back to the beginning and take a deeper look at some of the things I've done to make these changes work.  </p>
)

@section('post-content')
{!! $item['excerpt'] !!}
@endsection
