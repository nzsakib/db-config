<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    
    <div class="container">
        <div class="row">
            {{ dd(config()->all()) }}
        </div>
    </div>


    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>