@extends('_layouts.master')

@section('body')
    @collectitem({
        "title": "This is the End",
        "author": "Jim Morrison"
    })
    <div class="jumbotron"><h1>The Knots Wall</h1></div>
    <h1>{{ $title or 'none'}}</h1>
    <p><sub>by {{ $author or 'none' }}</sub></p>
    <pre>
This is the end, beautiful friend
This is the end, my only friend, the end
Of our elaborate plans, the end
Of everything that stands, the end
No safety or surprise, the end
I'll never look into your eyes, again
Can you picture what will be, so limitless and free
Desperately in need, of some, stranger's hand
In a, desperate land
Lost in a Roman wilderness of pain
And all the children are insane, all the children are insane
Waiting for the summer rain, yeah
There's danger on the edge of town
Ride the King's highway, baby
Weird scenes inside the gold mine
Ride the highway west, baby
Ride the snake, ride the snake
To the lake, the ancient lake, baby
The snake is long, seven miles</pre>
@endsection