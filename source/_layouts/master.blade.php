<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/main.js"></script>
        <script src="/js/app.js"></script>
    </head>
    <body>
        <div class="well">
            <h1><a href="/">Th<span class="laravel">e</span> Kn<span class="laravel">ot</span>s <span class="laravel">W</span>a<span class="laravel">ll</span></a></h1>
            <div><small>Powered by <a href="https://github.com/tightenco/jigsaw/">Jigsaw</a></small></div>
        </div>
        <div class="container-fluid">
            <div class="col-sm-9">
                @yield('body')
            </div>
            <div class="col-sm-3">
                @include('_layouts.sidebar')
            </div>
        </div>
    </body>
</html>
