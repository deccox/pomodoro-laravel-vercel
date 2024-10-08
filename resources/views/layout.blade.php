<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calender.css') }}">
    <script src="https://kit.fontawesome.com/db387ad2ac.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://moment.github.io/luxon/global/luxon.js"></script>
    <title>Pomodoro</title>
</head>
<body>
    <main>
        @include('componentes.timer')
        @include('componentes.calender')
    </main>



    <script>
        var DateTime = luxon.DateTime;
    </script>
    @stack('timerscripts')
    @stack('calenderscripts')
</body>
</html>