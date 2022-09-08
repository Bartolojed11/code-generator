<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codeigniter Code Generator</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <div class="my-4">
            <h1 class="mx-auto" style="width: fit-content;">CodeIgniter Code Generator</h1>
        </div>
       
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>