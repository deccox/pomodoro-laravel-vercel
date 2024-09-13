<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/db387ad2ac.js" crossorigin="anonymous"></script>
    <title>Pomodoro</title>
</head>
<body>
    <main>
        @include('componentes.timer')
        @include('componentes.calender')
    </main>
</body>
</html>