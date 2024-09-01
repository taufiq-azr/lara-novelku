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
    <title>Admin Novelku - Users</title>
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
        <section id="users">
            @if (Auth::check())
                <h2 class="my-4 fs-4">Welcome, {{ Auth::user()->username }}</h2>
            @else
                <h2 class="my-4 fs-4">Create Users</h2>
            @endif

            <div class="card card-with-shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="my-2 fs-5 container fw-bold">Create Users</h3>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Create Users</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false">Manage Users</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <form action="{{ route('post_user') }}" method="POST" enctype="multipart/form-data">
                            <!-- Ubah route menjadi post_user -->
                            @csrf
                            <div class="mb-3 container-fluid">
                                <label for="email-users" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email-users" id="email-users"
                                    placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="username-users" class="form-label">Username <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username-users" id="username-users"
                                    required>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="password-users" class="form-label">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password-users"
                                    id="password-users" required>
                            </div>
                            <div class="mb-3 container-fluid">
                                <label for="confirm-password" class="form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="confirm-password"
                                    id="confirm-password" required>
                                <div class="invalid-feedback">Passwords do not match.</div>
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
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th style="width: 1rem;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through Users data --}}
                                    @forelse ($users as $user)
                                        <!-- Ubah novels menjadi users -->
                                        <tr>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                <div class="row container-fluid">
                                                    <a href="#" class="btn btn-primary my-2 edit-button"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-username="{{ $user->username }}">Edit</a>
                                                    <!-- Ubah novel-genre menjadi user-username -->

                                                    <form id="deleteForm_{{ $user->id }}"
                                                        action="{{ route('delete_user', $user->id) }}"
                                                        method="POST"> <!-- Ubah route menjadi delete_user -->
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
                                            <td colspan="6">No users found.</td>
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
                            <h5 class="modal-title" id="editModalLabel">Edit Users</h5>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" action="{{ route('edit_users') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" name="user-modal-id" id="user-modal-id">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" id="user-modal-email"
                                        name="user-modal-email" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="col-form-label">username</label>
                                    <input type="text" class="form-control" id="modal-username"
                                        name="modal-username" required readonly>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">New Password</label>
                                        <input type="password" class="form-control" id="user-modal-password"
                                            name="user-modal-password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm-password-modal"
                                        id="confirm-password-modal" required>
                                    <div class="invalid-feedback">Passwords do not match.</div>
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
        <div id="error-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                    </div>
                    <div class="modal-body">
                        <p id="error-message">Kata sandi tidak cocok</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi yang dipanggil saat modal edit ditampilkan
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var userId = button.data('user-id');
                var userEmail = button.data('user-email');
                var userUsername = button.data('user-username');

                // Cetak informasi pengguna ke konsol
                console.log("User ID:", userId);
                console.log("User Email:", userEmail);
                console.log("User Username:", userUsername);

                var modal = $(this);

                // Menetapkan nilai informasi pengguna ke dalam modal
                modal.find('#user-modal-id').val(userId);
                modal.find('#modal-username').val(userUsername);
                modal.find('#user-modal-email').val(userEmail);
            });

            // Fungsi yang dipanggil saat tombol "Simpan Perubahan" ditekan
            $('#saveChanges').on('click', function() {
                // Menampilkan konfirmasi sebelum menyimpan perubahan
                if (confirm("Apakah Anda yakin ingin menyimpan perubahan?")) {
                    $('#editForm').submit(); // Mengirim formulir untuk disimpan
                }
            });

            // Seleksi elemen notifikasi
            var successAlert = document.getElementById('success-alert');
            var errorAlert = document.getElementById('error-alert');

            // Hapus notifikasi setelah 3 detik
            setTimeout(function() {
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 3000);
            // Fungsi untuk memvalidasi password sebelum mengirim formulir
            document.getElementById('submitBtn').addEventListener('click', function(event) {
                var password = document.getElementById('password-users').value;
                var confirmPassword = document.getElementById('confirm-password').value;

                if (password !== confirmPassword) {
                    event.preventDefault(); // Mencegah pengiriman formulir jika password tidak cocok
                    document.getElementById('confirm-password').classList.add(
                        'is-invalid'); // Menandai input dengan class is-invalid
                }
            });


        });
    </script>
    @if (session('error_message'))
        <script>
            $(document).ready(function() {
                $('#error-modal').modal('show');
            });
        </script>
    @endif
</body>

</html>
