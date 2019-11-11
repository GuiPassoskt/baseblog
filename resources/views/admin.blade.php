<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"> --}}
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ mix('assets/admin/css/app.css') }}">
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <script src="{{ mix('/assets/admin/js/app.js') }}"></script>
    @if(app()->isLocal())
        <script src="http://localhost:35729/livereload.js"></script>
    @endif

</body>
</html>