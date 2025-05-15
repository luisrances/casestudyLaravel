<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <x-nav-bar></x-nav-bar>
    <div class="pt-[100px] max-w-screen-xl mx-auto">
            {{ $slot }} 
    </div>
    <x-Footer></x-Footer>

    @vite('resources/js/app.js')
</body>
</html>