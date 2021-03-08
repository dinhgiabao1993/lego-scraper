<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Grab Clone</title>

        <link href="/css/app.css" rel="stylesheet">
        <style>
            div[v-cloak] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div v-cloak id="app"></div>
    </body>
    <script src="/js/app.js"></script>
</html>
