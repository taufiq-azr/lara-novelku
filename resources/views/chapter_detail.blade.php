<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter - Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<style>
    body {
        color: #333;
        background-color: #f3f3f3;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 400;
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

    nav a {
        /* Remove default link styles */
        text-decoration: none;
        color: inherit;
        /* Use the same color as parent text */
        cursor: default;
        /* Remove pointer cursor */
    }

    nav a:hover {
        /* Style for hover state (optional) */
        color: #333;
        /* Change text color on hover */
        text-shadow: 0 0 2px #ddd;
        /* Add subtle shadow on hover */
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
    <main class="container-fluid my-4">
        <section id="content">
            <div class="container-fluid col-md-8">
                @if ($novels)
                    <h2 class="my-6 fs-4"
                        style="color: #333; font-size: 1.5em;
                        margin-block-start: 0.83em;
                        margin-block-end: 0.83em;
                        margin-inline-start: 0px;
                        margin-inline-end: 0px;
                        font-weight: bold;
                        unicode-bidi: isolate; text-align: center;">
                        {{ $novels->title }} - Bahasa Indonesia
                    </h2><br>
                    <nav class="" style="font-style: italic; font-size: .8rem; line-height: 1em; color: #888">
                        <a href="{{ route('index') }}">Home /</a>
                        <a href="{{ route('show', $novels->novel_id) }}">
                            {{ $novels->title }}
                        </a>
                    @else
                        <p>No novels found for the selected chapter.</p>
                @endif
                <a> /
                    <?php
                    // Periksa apakah ada parameter bab yang dipilih dalam URL
                    if (isset($_GET['title'])) {
                        $selectedTitle = urldecode($_GET['title']);
                        echo $selectedTitle;
                    } else {
                        echo 'Tidak Ada Bab yang Dipilih';
                    }
                    ?>
                </a>

                </nav>
                <div class="container">
                    <div class="btn-group my-2" style="float: right;">
                        @php
                            use App\Models\Chapters;

                            // Dapatkan bab saat ini berdasarkan chapter_id
                            $currentChapter = Chapters::where('chapter_id', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->first();

                            // Dapatkan bab sebelumnya dan berikutnya
                            $prevChapter = Chapters::where('chapter_id', '<', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->orderBy('chapter_id', 'desc')
                                ->first();
                            $nextChapter = Chapters::where('chapter_id', '>', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->orderBy('chapter_id', 'asc')
                                ->first();
                        @endphp

                        @if ($prevChapter)
                            <a href="{{ route('chapter_detail', ['chapter' => $prevChapter->chapter_id, 'title' => urlencode($prevChapter->title)]) }}"
                                class="btn btn-dark">← Prev</a>
                        @endif

                        @if ($nextChapter)
                            <a href="{{ route('chapter_detail', ['chapter' => $nextChapter->chapter_id, 'title' => urlencode($nextChapter->title)]) }}"
                                class="btn btn-dark ms-2">Next →</a>
                        @endif
                    </div>




                </div><br />

                <div class="my-5">
                    @if ($chapter)
                        <p>
                            {!! nl2br(e($chapter->content)) !!}
                        </p>
                    @else
                        <p>No novels found for the selected chapter.</p>
                    @endif
                </div>
                <div class="container">
                    <div class="btn-group mb-4" style="float: right;">
                        @php

                            // Dapatkan bab saat ini berdasarkan chapter_id
                            $currentChapter2 = Chapters::where('chapter_id', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->first();

                            // Dapatkan bab sebelumnya dan berikutnya
                            $prevChapter2 = Chapters::where('chapter_id', '<', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->orderBy('chapter_id', 'desc')
                                ->first();
                            $nextChapter2 = Chapters::where('chapter_id', '>', $chapter->chapter_id)
                                ->where('novel_id', $chapter->novel_id)
                                ->orderBy('chapter_id', 'asc')
                                ->first();
                        @endphp

                        @if ($prevChapter2)
                            <a href="{{ route('chapter_detail', ['chapter' => $prevChapter2->chapter_id, 'title' => urlencode($prevChapter2->title)]) }}"
                                class="btn btn-dark">← Prev</a>
                        @endif

                        @if ($nextChapter2)
                            <a href="{{ route('chapter_detail', ['chapter' => $nextChapter2->chapter_id, 'title' => urlencode($nextChapter->title)]) }}"
                                class="btn btn-dark ms-2">Next →</a>
                        @endif
                    </div>

                </div><br />
            </div>
        </section>
    </main>

    <!-- Your scripts here -->
</body>

</html>
