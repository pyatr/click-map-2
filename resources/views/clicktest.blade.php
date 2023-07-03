<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test click</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            display: grid;
            justify-content: center;
            align-content: center;
        }
    </style>
</head>
<body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="module" src="{{asset("js/registerUserClick.js")}}"></script>
You can click around
</body>
</html>
