<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novels; // Pastikan Anda mengganti namespace dan model dengan yang sesuai

class AdminController extends Controller
{
    public function adminPage()
    {
        // Ambil data novels dari database
        $novels = Novels::all(); // Misalnya, Anda memiliki model Novel yang sesuai

        // Tampilkan halaman admin dengan data novels
        return view('admin.admin_page', ['novels' => $novels]);
    }

    // Metode lainnya untuk menangani logika admin...
}
