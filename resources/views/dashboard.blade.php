<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('wheel/css/style.css') }}">

    <title>
        {{config('app.name')}}
    </title>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-130950821-1');
    </script>
    <style>

        /* body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        } */

        .btn {
            font-size: 1.5rem;
            padding: 1rem 2rem;

            width: 100%;
        }

        .btn-lg {
            font-size: 2rem;
            padding: 1.5rem 3rem;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <section class="register">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <img src="{{ asset('image/luckydraw-images-02.png') }}" width="70%" />
                    </div>

                    <div style="margin-top: 20%;">
                    <div class="col-md-6 mx-auto text-center">
                <div class="mb-4">
                    <a href="{{route('index')}}" class="btn btn-primary btn-lg btn-block">Start</a>
                </div>
                <div class="mb-2">
                    <a href="{{route('admin.logout')}}" class="btn btn-danger btn-lg btn-block">Logout</a>
                </div>
            </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <!-- <div class="row">
            <div class="col-12">
                <div class="logo">
                    <img src="{{ asset('image/luckydraw-images-02.png') }}" width="70%" />
                </div>
            </div>
        </div>
        <div class="row">
          
        </div> -->
    </div>
</body>