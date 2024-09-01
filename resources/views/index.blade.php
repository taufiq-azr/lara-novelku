<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novelku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            color: #333333;
            background-color: #F2F2F2;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 300;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important
        }

        .carousel-item img {
            width: auto;
            max-height: 200px;
            margin: 0 auto;
        }

        .card-with-shadow {
            box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
            -webkit-box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    <header>
        <nav class=" navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fs-4 fw-bold" href="{{ route('index') }}">NovelKu</a>

                <button class="btn btn-dark active">
                    <a href="{{ route('login') }}" class="text-reset text-decoration-none fw-bold">LOGIN</a>
                </button>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        <section id="Carousel">
            <h2 class="my-4 fs-4">RANDOM NOVEL</h2>
            <div id="lastUpdateCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $shuffledNovels = $novels->shuffle();
                    @endphp

                    <div id="novelCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($shuffledNovels->chunk(6) as $novelChunk)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($novelChunk as $novel)
                                            <div class="col-md-2">
                                                <a href="{{ route('show', ['novel' => $novel->novel_id]) }}">
                                                    <img src="{{ asset('uploads/' . $novel->cover_image) }}"
                                                        class="d-block img-thumbnail mx-auto"
                                                        alt="Cover Image for {{ $novel->title }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section id="last-update">
            <h2 class="my-4 fs-4">LAST UPDATE</h2>
            <div class="row">
                @foreach ($novels as $novel)
                    <article class="populer col-md-6 mb-4">
                        <div class="card card-with-shadow h-100">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('uploads/' . $novel->cover_image) }}" class="img-thumbnail"
                                        alt="Cover Image for {{ $novel->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $novel->title }}</h5>
                                        <p class="card-text">Genre: {{ $novel->genre }} | Status: {{ $novel->status }}
                                        </p>
                                        <a href="{{ route('show', $novel->novel_id) }}" class="btn btn-dark">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Web Novelku. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
