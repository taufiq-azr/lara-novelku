<!-- resources/views/admin/admin_page.blade.php -->
@if (session('status') == 'success')
    <div id="success-alert" class="alert alert-success" role="alert">Status Berhasil.</div>
@elseif(session('status') == 'error')
    <div id="error-alert" class="alert alert-danger" role="alert">Status Gagal.</div>
@endif

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Novelku - Chapters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer {
            background-color: #f1f1f1;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .card-with-shadow {
            box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
            -webkit-box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px -2px 8px 3px rgba(0, 0, 0, 0.15);
        }

        .custom-modal-width {
            max-width: 80%;
            /* Atur lebar sesuai kebutuhan, misalnya 80% dari lebar layar */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="../assets/svg/book.svg" alt="Bootstrap" width="30" height="24">Admin Novelku
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('admin.admin_page') }}">Manage Novels</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.chapters') }}">Manage chapters</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}">Manage Users</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        <section id="users">
            @if (Auth::check())
                <h2 class="my-4 fs-4">Welcome, {{ Auth::user()->username }}</h2>
            @else
                <h2 class="my-4 fs-4">Create Users</h2>
            @endif

            <div class="card card-with-shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="my-2 fs-5 container fw-bold">Create Chapters</h3>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Create Chapters</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false">Manage Chapters</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <form action="{{ route('post_chapter') }}" method="POST" enctype="multipart/form-data">
                            <!-- Ubah route menjadi post_user -->
                            @csrf
                            <div class="mb-3 container-fluid">
                                <label for="novels_id" class="form-label">ID Novel <span class="text-danger">*</span>
                                </label>
                                <select id="novels_id" name="novels_id" class="form-select" required>
                                    <option value="" selected disabled>Select ID Novel</option>
                                    @foreach ($novels as $novel)
                                        <option value="{{ $novel->novel_id }}">{{ $novel->novel_id }} -
                                            {{ $novel->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 container-fluid">
                                <label for="judul-chapters" class="form-label">Judul Chapter<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="judul-chapters" id="judul-chapters"
                                    placeholder="name@example.com" required>
                            </div>

                            <div class="mb-3 container-fluid">
                                <label for="konten-chapters" class="form-label">Konten <span
                                        class="text-danger">*</span></label>
                                <textarea rows="10" style="height:100%;" class="form-control" name="konten-chapters" id="konten-chapters"
                                    aria-label="With textarea" required></textarea>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="chapter_number" class="form-label">Chapter Number<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="chapter_number" id="chapter_number"
                                    required>
                            </div>
                            <div class="container-fluid">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            </div><br />
                        </form>
                    </div>

                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="container-fluid">
                            <table class="table table-light table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>ID Novels</th>
                                        <th>Judul Chapters</th>
                                        <th>Konten</th>
                                        <th>Chapter Number</th>
                                        <th style="width: 1rem;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($chapters as $chapter)
                                        <!-- Ubah chapterss menjadi chapter -->
                                        <tr>
                                            <td>{{ $chapter->novel_id }} -
                                                {{ $novelTitles[$chapter->novel_id] ?? 'Unknown' }}</td>
                                            <td>{{ $chapter->title }}</td>
                                            <td>
                                                @php
                                                    $paragraphs = explode("\n", $chapter->content);
                                                @endphp
                                                @foreach ($paragraphs as $paragraph)
                                                    <p style="text-align: justify;">{{ $paragraph }}</p>
                                                @endforeach
                                            </td>
                                            <td>{{ $chapter->chapter_number }}</td>
                                            <td>
                                                <div class="row container-fluid">
                                                    <a href="#" class="btn btn-primary my-2 edit-button"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-chapter-id="{{ $chapter->chapter_id }}"
                                                        data-chapter-novel_id="{{ $chapter->novel_id }}"
                                                        data-chapter-title="{{ $chapter->title }}"
                                                        data-chapter-content="{{ $chapter->content }}"
                                                        data-chapter-chapter_number="{{ $chapter->chapter_number }}">Edit</a>



                                                    <form id="deleteForm_{{ $chapter->chapter_id }}"
                                                        action="{{ route('delete_chapter', $chapter->chapter_id) }}"
                                                        method="POST"> <!-- Ubah route menjadi delete_chapter -->
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger my-2"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Chapters found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="modal-edit">
            <!-- Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog custom-modal-width" role="document"> <!-- Tambahkan kelas kustom di sini -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Chapters</h5>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" action="{{ route('edit_chapter') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" name="chapter-modal-id"
                                    id="chapters-modal-id">
                                <input type="hidden" class="form-control" name="chapters-modal-novel_id"
                                    id="chapters-modal-novel_id">

                                <div class="form-group">
                                    <label for="chapters-modal-judul" class="col-form-label">Judul Chapter</label>
                                    <input type="text" class="form-control" id="chapters-modal-judul"
                                        name="chapters-modal-judul" required>
                                </div>

                                <div class="form-group">
                                    <label for="chapters-modal-content" class="col-form-label">Konten</label>
                                    <textarea rows="10" class="form-control" id="chapters-modal-content" name="chapters-modal-content" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="chapters-modal-chapter_number" class="col-form-label">Chapter
                                        Number</label>
                                    <input type="number" class="form-control" id="chapters-modal-chapter_number"
                                        name="chapters-modal-chapter_number" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- ERROR POP UP -->

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk menangani penampilan modal edit
            function showEditModal(event) {
                var button = $(event.relatedTarget);
                var chapterId = button.data('chapter-id');
                var novelId = button.data('chapter-novel_id');
                var chapterTitle = button.data('chapter-title');
                var chapterContent = button.data('chapter-content');
                var chapterNumber = button.data('chapter-chapter_number');

                var modal = $('#editModal');

                // Menetapkan nilai informasi chapter ke dalam modal
                modal.find('#chapters-modal-id').val(chapterId);
                modal.find('#chapters-modal-novel_id').val(novelId);
                modal.find('#chapters-modal-judul').val(chapterTitle);
                modal.find('#chapters-modal-content').val(chapterContent);
                modal.find('#chapters-modal-chapter_number').val(chapterNumber);
            }

            // Fungsi untuk menangani klik tombol "Simpan Perubahan"
            function saveChanges() {
                if (confirm("Apakah Anda yakin ingin menyimpan perubahan?")) {
                    $('#editForm').submit();
                }
            }

            // Fungsi untuk menyembunyikan notifikasi setelah 3 detik
            function hideAlerts() {
                var successAlert = document.getElementById('success-alert');
                var errorAlert = document.getElementById('error-alert');

                setTimeout(function() {
                    if (successAlert) {
                        successAlert.style.display = 'none';
                    }
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 3000);
            }

            // Event listener untuk menampilkan modal edit
            $('#editModal').on('show.bs.modal', showEditModal);

            // Event listener untuk tombol "Simpan Perubahan"
            $('#saveChanges').on('click', saveChanges);

            // Sembunyikan notifikasi setelah 3 detik
            hideAlerts();
        });
    </script>







</body>

</html>
