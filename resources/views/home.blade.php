<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

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

        a {
            color: black;
        }
    </style>
</head>
<body>
<a href="/click-test">Test clicks</a>
<a href="/click-tracked">Add new tracked websites</a>
<a href="/click-map">Coordinates graph</a>
<a href="/click-hours">Clicks by hours</a>
</body>
</html>
