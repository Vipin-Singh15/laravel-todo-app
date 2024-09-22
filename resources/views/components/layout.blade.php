<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Todo App' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="container mx-auto w-[60%] p-8">
        {{ $slot }} <!-- This is where the content will go -->
        <script src="{{ 'app.js' }}"></script>
    </div>
</body>

</html>
