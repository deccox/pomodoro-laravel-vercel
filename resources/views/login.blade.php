<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('authenticate') }}" method="POST">
        @csrf
        <label for="username">
        user
            <input type="text" name="username" id="username">
        </label>
        
        <label for="password">
        password
        <input type="password" name="password" id="password">
        </label>
        <button>Enviar</button>

        @error('username')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </form>
</body>
</html>