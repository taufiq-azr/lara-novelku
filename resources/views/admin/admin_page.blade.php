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
    <title>Admin Novelku - Novels</title>
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
        <section id="novels">
            @if (Auth::check())
                <h2 class="my-4 fs-4">Welcome, {{ Auth::user()->username }}</h2>
            @else
                <h2 class="my-4 fs-4">Create Novels</h2>
            @endif
            <div class="card card-with-shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="my-2 fs-5 container fw-bold">Create Novels</h3>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Create</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false">Manage Novels</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <form action="{{ route('post_novel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 container-fluid">
                                <label for="nama_novel" class="form-label">Nama Novel</label>
                                <input type="text" class="form-control" name="nama_novel" id="nama_novel" required>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="genre" class="form-label">Genre</label>
                                <select id="genre" name="genre" class="form-select" required>
                                    <option value="" selected disabled>Select Genre</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Xianxia">Xianxia</option>
                                </select>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="deskripsi" class="form-label">Sinopsis Novel</label>
                                <textarea rows="10" style="height:100%;" class="form-control" name="deskripsi" id="deskripsi"
                                    aria-label="With textarea" required></textarea>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="cover" class="form-label">Cover Novel</label>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="fileToUpload">Upload Cover</label>
                                    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload"
                                        required>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div><br />
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="container-fluid">
                            <table class="table table-light table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Genre</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Cover Image</th>
                                        <th style="width: 1rem;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through novels data --}}
                                    @forelse ($novels as $novel)
                                        <tr>
                                            <td>{{ $novel->title }}</td>
                                            <td>{{ $novel->genre }}</td>
                                            <td>{{ $novel->status }}</td>
                                            <td>
                                                @php
                                                    $paragraphs = explode("\n", $novel->description);
                                                @endphp
                                                @foreach ($paragraphs as $paragraph)
                                                    <p style="text-align: justify;">{{ $paragraph }}</p>
                                                @endforeach
                                            </td>

                                            <td><img style="width: 10rem;"
                                                    src="{{ asset('../uploads/' . $novel->cover_image) }}"
                                                    class="img-thumbnail" alt="Cover Image for {{ $novel->title }}">
                                            </td>
                                            <td>
                                                <div class="row container-fluid">

                                                    <a href="#" class="btn btn-primary my-2 edit-button"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-novel-id="{{ $novel->novel_id }}"
                                                        data-novel-title="{{ $novel->title }}"
                                                        data-novel-genre="{{ $novel->genre }}"
                                                        data-novel-status="{{ $novel->status }}"
                                                        data-novel-description="{{ $novel->description }}">Edit</a>


                                                    <form id="deleteForm_{{ $novel->novel_id }}"
                                                        action="{{ route('delete_novel', $novel->novel_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger my-2"
                                                            onclick="return confirm('Are you sure you want to delete this novel?')">Delete</button>
                                                    </form>

                                                </div>
                        </div>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No novels found.</td>
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
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Novel</h5>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" action="{{ route('edit_novel') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" name="novel_id" id="modal-novel_id">
                                <div class="form-group">
                                    <label for="title" class="col-form-label">Title</label>
                                    <input type="text" class="form-control" id="modal-title" name="title"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="genre" class="form-label">Genre</label>
                                    <select id="modal-genre" name="genre" class="form-select" required>
                                        <option value="" disabled>Select Genre</option>
                                        <option value="Fantasy">Fantasy</option>
                                        <option value="Romance">Romance</option>
                                        <option value="Xianxia">Xianxia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="modal-status" name="status" class="form-select" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Sinopsis</label>
                                    <textarea class="form-control" id="modal-deskripsi" name="description" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cover" class="form-label">Cover Novel</label>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="fileToUpload">Upload Cover</label>
                                        <input type="file" class="form-control" id="modal-fileToUpload"
                                            name="fileToUpload">
                                    </div>
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
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi yang dipanggil saat modal edit ditampilkan
            $('#editModal').on('show.bs.modal', function(event) {
                // Mendapatkan informasi novel dari tombol yang dipilih
                var button = $(event.relatedTarget);
                var novelId = button.data('novel-id');
                var novelTitle = button.data('novel-title');
                var novelGenre = button.data('novel-genre');
                var novelStatus = button.data('novel-status');
                var novelDescription = button.data('novel-description');

                // Menetapkan nilai informasi novel ke dalam modal
                var modal = $(this);
                modal.find('#modal-novel_id').val(novelId);
                modal.find('#modal-title').val(novelTitle);
                modal.find('#modal-genre').val(novelGenre);
                modal.find('#modal-status').val(novelStatus);
                modal.find('#modal-deskripsi').val(novelDescription);
            });

            // Fungsi yang dipanggil saat tombol "Simpan Perubahan" ditekan
            $('#saveChanges').on('click', function() {
                // Memunculkan konfirmasi sebelum menyimpan perubahan
                if (confirm("Apakah Anda yakin ingin menyimpan perubahan?")) {
                    $('#editForm').submit(); // Mengirimkan formulir untuk disimpan
                }
            });
        });

        // Fungsi untuk menghapus notifikasi setelah 3 detik
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
    </script>
    </script>
</body>

</html>
