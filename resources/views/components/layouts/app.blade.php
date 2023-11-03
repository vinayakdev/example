<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ 'Contact From' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body x-data="{
    init() {}
}">

    {{ $slot }}
</body>

</html>
