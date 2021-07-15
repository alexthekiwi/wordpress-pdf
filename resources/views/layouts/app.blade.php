<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <title>PDF Generator</title>

    @yield('head')
</head>
<body class="bg-gray-50">
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
