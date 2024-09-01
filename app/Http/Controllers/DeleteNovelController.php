<?php

namespace App\Http\Controllers;

use App\Models\Novels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteNovelController extends Controller
{
    public function delete($id)
    {
        // Temukan novel berdasarkan ID
        $novel = Novels::find($id);

        // Periksa apakah novel ditemukan
        if ($novel) {
            // Hapus gambar terkait jika ada
            $this->deleteCoverImage($novel);

            // Hapus novel
            $novel->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.admin_page')->with('status', 'success');
        } else {
            // Redirect dengan pesan kesalahan jika novel tidak ditemukan
            return redirect()->route('admin.admin_page')->with('status', 'error')->with('message', 'Novel not found');
        }
    }

    // Fungsi untuk menghapus gambar cover jika ada
    private function deleteCoverImage($novel)
    {
        if ($novel->cover_image) {
            $file_path = public_path('uploads/' . $novel->cover_image);
            if (file_exists($file_path)) {
                unlink($file_path);
                // Menghapus file dari sistem file
            }
        }
    }
}
