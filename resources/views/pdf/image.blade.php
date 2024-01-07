<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            background-image: url('{{ asset('storage/background/Capture.PNG') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            color: #ffffff;
            text-shadow: 2px 2px 4px #000000;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <!-- Additional content can be added here -->
</body>
</html>
