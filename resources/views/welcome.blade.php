<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div>
        <div x-data="{ open: false }">
            <button @click="open = !open">Toggle</button>
            <div x-show="open">
                <p>Content goes here...</p>
            </div>
        </div>        
    </div>
</body>
</html>
