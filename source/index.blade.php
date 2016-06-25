@extends('_layouts.master')

@section('body')
    @blogmeta({
        "title": "This is the End",
        "author": "My only friend, the End."
    })
    <div class="jumbotron"><h1>The Knots Wall</h1></div>
    <h1>{{ $title or 'none'}}</h1>
    <p><sub>by {{ $author or 'none' }}</sub></p>
    <p>@doofus('Goodbye, dino!')</p>
@endsection