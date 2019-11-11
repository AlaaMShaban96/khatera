<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>{{ $post->titel }}</title>
</head>

<body>
    <div class="card">
        <img class="card-img-top" height="300px" src="{{ $post->imge_link }}" alt="">
        <div class="card-body">
            <h4 class="card-title">{{ $post->titel }}</h4>
            <p class="card-text">{{ $post->text }}</p>
        </div>
    </div>

</body>

</html>