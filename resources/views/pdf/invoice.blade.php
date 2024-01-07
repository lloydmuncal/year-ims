<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .cover-page,
        .page-container {
            position: relative;
            height: 100%;
        }

        .cover-page {
            background-image: url('data:image/jpeg;base64,{{ base64_encode($cover) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .bckgrnd1
        .page-container {
            position: relative;
            height: 100%;
        }

        .bckgrnd1{
            background-image: url('data:image/jpeg;base64,{{ base64_encode($background1) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        

        .page-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay-image {
            position: absolute;
            /* Set other common styles as needed */
            width: 75px;
            height: 105px;
        }


    </style>
</head>
<body>
    <div class="cover-page"></div>
    <div class="bckgrnd1"></div>
    @foreach ($pagesData as $page)
        <div class="page-container">
            <img src="data:image/jpeg;base64,{{ base64_encode($page['background']) }}" alt="Page Image">
            @foreach ($page['images'] as $index => $image)
                @if ($index === 0)
                    <img src="data:image/jpeg;base64,{{ base64_encode($image['data']) }}" alt="Overlay Image" class="overlay-image position-{{ $index }}" style="width: 37%; height: 35%; top: 18%; left: 9%; border: 2px solid #888;">
                @elseif ($index === 1)
                    <img src="data:image/jpeg;base64,{{ base64_encode($image['data']) }}" alt="Overlay Image" class="overlay-image position-{{ $index }}" style="width: 37%; height: 35%; top: 18%; left: 54%; border: 2px solid #888;">
                @elseif ($index === 2)
                    <img src="data:image/jpeg;base64,{{ base64_encode($image['data']) }}" alt="Overlay Image" class="overlay-image position-{{ $index }}" style="width: 37%; height: 35%; top: 58%; left: 9%; border: 2px solid #888;">
                @elseif ($index === 3)
                    <img src="data:image/jpeg;base64,{{ base64_encode($image['data']) }}" alt="Overlay Image" class="overlay-image position-{{ $index }}" style="width: 37%; height: 35%; top: 58%; left: 54%; border: 2px solid #888;">
            @endif
        @endforeach
        </div>
    @endforeach
</body>
</html>
