@extends('_layouts.post')
@decorate

@collectitem({
    "title": "Proof of Concept for Jigsaw Build Decoration",
    "author": "Keith Freeman",
    "published": "2016-07-01 14:01",
    "tags": ["Build Decoration", "Collection"]
})
@postset(excerpt,
<p>I wanted to create a way to track meta data using Blade directives rather than do some crazy YAML front matter parsing or something similar.  The idea would be to put your meta data into a Blade directive that would then collect the meta data as well as make it available for use within the Blade file.  After the initial build is complete, all meta data would be collected and could then be used to "decorate" the build by providing the ability to index the collection, create rss feeds, archive links, etc.  The question became, how do I decorate the build?  The best answer I came up with was to "reprocess" the build as if it were still Blade files.  This gives you the ability to place your "decorations" within <code>&commat;verbatim</code> tags.  After the initial build, the <code>&commat;verbatim</code> tags are removed and your second layer of Blade directives is exposed.  Iterative or recursive Blade compilation.  How cool is that?</p>
)

@section('post-content')
{!! $item['excerpt'] !!}
<p>There were a couple of challenges to overcome.  I didn't want to change the way regular Blade files were handled, so I needed another file handler that could handle those Blade files that needed to be processed more than once.  Then I had to keep track of what files were being decorated so I would know what to name the file once the handler was complete, i.e. does this get turned into a pretty url, or does this need to wait around to get reprocessed again.</p>
<p>The changes to Jigsaw are basically three-fold.</p>
<ol>
    <li>Setup a plugin system that exposes key parts of the application like file handling and Blade compilation and allows the user to make substitutions and/or extensions to the functionality.</li>
    <li>Add the ability to decorate a build iteratively.</li>
    <li>Create a plugin to collect meta data from Blade files and decorate the build with information gathered in the collection.</li>
</ol>
<p>Step 1 basically moves the container object used by the build closer to center stage.  The container becomes the <code>Puzzle Box</code>, an extension of the <code>Container</code> class, that will register these plugins, called <code>Puzzle Pieces</code>, and tag them for use in the main <code>Jigsaw</code> instance.  It also reworks the file handlers into <code>Puzzle Pieces</code>.</p>
<p>Step 2 gets a little complicated.  Jigsaw will create an initial build and store it in the normal destination directory.  If there are any <code>Build Decorators</code> (special kinds of <code>Puzzle Pieces</code>), then it will iterate through them, providing each of them with some information and hitting a <code>decorate</code> method on them to give them an opportunity to do cool stuff.  Then it will re-build the site again using the prior build result.  Repeat until finished!</p>
<p>Step 3 is where all the fun is.  Turns out I didn't need much of the functionality of the Build Decoration, but it leaves the application much more flexible for future great ideas. There is a new <code>Build Decorator</code> class called <code>Collector</code>, and another class called <code>Posts</code>.  The <code>Collector</code> provides two Blade directives: <code>collectitem</code> and <code>collectindex</code>.  The first one will accept a bunch of meta data (in JSON format) that gets passed to an implementation of the <code>Collection</code> interface.  This interface requires a single method <code>collect</code> that should accept the meta data.  The default implementation is <code>Posts</code>, but you can specify another one by providing a class name in the <code>collection_type</code> key of the meta data passed to the Blade directive.  <code>Posts</code> will take the meta data and record it, building up some default values if they are not provided.  The only required key is <code>title</code>, which is slugged to create the eventual pretty URL.  This directive will also extract all of the meta data into the symbol table for the scope of the Blade file, so nothing needs to be typed in twice.  The other directive, <code>collectindex</code>, simply injects the <code>Collection</code> implementation into the Blade file scope as <code>$collection</code>.  From there, you can do with it as you will.  If <code>collectindex</code> is not given any parameters, it will inject the <code>Posts</code> instance by default.</p>
<h3>How do you use it?</h3>
<p>In your source directory, you create Blade files that will get processed as normal.  To take advantage of the <code>Posts</code> collection and the Build Decoration process, you must do three things: suffix the file with <code>posts.process.php</code>, wrap any <code>&commat;collectindex</code> directives in <code>&commat;verbatim</code> tags, and add the <code>&commat;decorate</code> directive to any primary Blade file that will require decoration.  The first thing simply ensures that the proper <code>File Handler</code> will process the file.  This is required because the file name must be preserved until the Build Decoration is done.  The normal process will rename the file on the first build.  The second thing will make sure that your directives that use the <code>Collection</code> object are hidden from the Blade compiler until there is something to actually use.  The third helps the <code>File Handler</code> know when the file is ready to be renamed.</p>
<p>In this repo, checkout the <code>source</code> directory.  It looks very similar to a basic Jigsaw <code>source</code> directory.  Note the <code>index.posts.process.php</code> file.  It contains a <code>&commat;collectindex</code> directive and includes another Blade file, <code>archives</code>, that also makes use of that directive.  Then look at the <code>posts</code> directory.  Here are some sample posts that use the <code>&commat;collectitem</code> directive.  Now check out the site in action [here](http://knots-wall.pubstorm.site/).  You see the posts were collected and indexed for the front page.  A sidebar was created with some archive links.  And each post was sluggified and saved.</p>
@endsection