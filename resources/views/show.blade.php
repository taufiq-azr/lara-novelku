<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novel Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<style>
    body {
        color: #F2F2F2;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
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
        <section id="content">
            <div class="container-fluid">
                <h2 class="my-4 fs-4" style="color: #333">{{ $novels->title }}</h2>
                <article class="content mb-4">
                    <div class="card h-200 card-with-shadow">
                        <div class="container-fluid">
                            <div class="row no-gutters">
                                <div class="col-md-2 ms-4 my-4">
                                    <div class="d-block overflow-hidden">
                                        <img style="border-radius: 10px 10px 10px 10px;
                                                    -webkit-border-radius: 10px 10px 10px 10px;
                                                    -moz-border-radius: 10px 10px 10px 10px;
                                                    "
                                            src="{{ asset('uploads/' . $novels->cover_image) }}"
                                            alt="{{ $novels->title }}" class="img-fluid rounded-top card-with-shadow">
                                    </div>
                                </div>
                                <div class="col-md-6 py-2">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold" style="color: #333">{{ $novels->title }}</h5>
                                        <div class="d-flex">
                                            <h6 class="card-title fs-6" style="color: #333"><b>Genre: </b>
                                                {{ $novels->genre }}</h6>
                                            <h6 class="card-title fs-6 ms-5" style="color: #333"><b>Status:
                                                </b>{{ $novels->status }}
                                            </h6>
                                        </div>
                                        <p class="card-text fs-6" style="text-align: justify; color: #333; ">
                                            <b>Sinopsis: </b>
                                        </p>
                                        <div class="card">
                                            <div class="container-fluid">
                                                <p class="card-text fs-6 ml-2 mr-2 mb-2 mt-2"
                                                    style="text-align: justify; color: #333; max-height: 196px; overflow-y: auto;">
                                                    {!! nl2br(e($novels->description)) !!}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-3">

                                            <a href="{{ route('chapter_detail', [
                                                'chapter' => $chapters->first()->chapter_id,
                                                'title' => urlencode($chapters->first()->title),
                                            ]) }}"
                                                class="btn btn-dark me-2">Read First</a>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </article>
            </div>
        </section>
        <section id="chapters">
            <div class="container-fluid">
                <h2 class="my-4 fs-4" style="color: #333">Latest Novel Releases</h2>
                <div class="card h-200 card-with-shadow">
                    <div class="container-fluid"><br />
                        <ul>
                            @foreach ($chapters as $chapter)
                                <li class="mb-2">
                                    <a href="{{ route('chapter_detail', ['chapter' => $chapter->chapter_id, 'title' => urlencode($chapter->title)]) }}"
                                        class="text-decoration-none text-dark">
                                        <span class="chapter-number fw-bold"
                                            style="font-weight: 600; color: #333; font-size:14px; line-height: 1.5;">
                                            {{ $chapter->title }}
                                        </span>
                                        -
                                        <span class="updated-at"
                                            style="font-style: italic; font-size: .8rem; line-height: 1em; color: #888">
                                            Diperbarui pada: {{ $chapter->updated_at->format('F j, Y') }}
                                        </span>
                                    </a>
                                    <?php
                                    // Asumsikan Anda memiliki manajemen sesi
                                    session()->put('selected_novel_id', $chapter->novel_id);
                                    session()->put('selected_chapter_title', $chapter->title);
                                    ?>
                                </li>
                            @endforeach


                        </ul>
                    </div>

                    </card>
                </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        console.log($chapters);
    </script>
</body>

</html>
