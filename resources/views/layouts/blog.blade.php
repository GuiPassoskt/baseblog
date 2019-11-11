<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
    .post-cover{
        height: 500px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        margin-bottom: 30px;
        margin-top: 30px;
    }
    </style>
    @yield('styles')
</head>
<body>  
    <div class="container">
        <h1 class="text-center mt-5">@yield('title')</h1>
    </div>

    <div class="post-cover" style="background-image: url(@yield('cover'))"></div>

    <div class="container">

        <div class='text-muted text-right mb-3'>@yield('info')</div>
        
        <div class="post-content">
            @yield('content')
        </div>
    </div>
    @yield('scripts')

    @if(app()->isLocal())
        <script>
        document.write(
            '<script src="http://' + location.host.split(':')[0] + ':35729/livereload.js?snipver=1"></' +
            'script>'
        );
        </script>
    @endif
</body>
</html>