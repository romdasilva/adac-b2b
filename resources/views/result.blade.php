<head>
    <style>
        img {
            border: 15px solid #ddd;
            border-radius: 14px;
            padding: 100px;
            width: 150px;
            margin-left: 20px;
            margin-top: 100px;
        }

        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
        }
    </style>
</head>

<body>

    @foreach ($pics as $pic)
    <img src="{{ asset('screenshot/'.$pic) }}" alt="{{ asset('screenshot/'.$pic) }}" style="width:1300px">
    <p class="center">{{$pic}} </p>
    @endforeach
</body>

</html>