<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
       @if (isset($title))
        {{ $title }}
       @else
        Gifts
       @endif
    </title>
    {{ Html::style('css/app.css') }}
    @stack('css')
</head>
<body>

    @include('_partial.err')
    @yield('content')

    {{Html::script("js/app.js")}}
    @stack('js')

</body>
</html>
