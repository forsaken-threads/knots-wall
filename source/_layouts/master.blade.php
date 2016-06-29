<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/other.css">
        <script src="/js/other.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="jumbotron"><h1><a href="/">The Knots Wall</a></h1></div>
            <div class="col-sm-8">
                @yield('body')
            </div>
            <div class="col-sm-4">
                <h3>Archives</h3>
                @include('_layouts.archives')
            </div>
            <div class="col-sm-12">Powered by Jigsaw</div>
        </div>
    </body>
</html>
