<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Novels as ModelsNovels;

class EditNovelController extends Controller
{
    public function update(Request $request)
    {
        // Memvalidasi apakah ada novel_id yang diterima
        $novel_id = $request->input('novel_id');
        if (!$novel_id) {
            return redirect()->route('admin.admin_page')->with('status', 'error')->with('message', 'novel_id not found');
        }

        // Temukan novel berdasarkan ID
        $novel = ModelsNovels::find($novel_id);
        if (!$novel) {
            return redirect()->route('admin.admin_page')->with('status', 'error')->with('message', 'Novel not found');
        }

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'required|string',
            'fileToUpload' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Update data novel
        $novel->title = $request->input('title');
        $novel->genre = $request->input('genre');
        $novel->status = $request->input('status');
        $novel->description = $request->input('description');

        // Proses file upload jika ada
        if ($request->hasFile('fileToUpload')) {
            $this->deleteCoverImage($novel); // Hapus cover lama jika ada
            $this->uploadNewCoverImage($request, $novel); // Unggah cover baru
        }

        // Simpan perubahan
        if ($novel->save()) {
            return redirect()->route('admin.admin_page')->with('status', 'success');
        } else {
            // Tampilkan pesan kesalahan jika gagal menyimpan perubahan
            return redirect()->route('admin.admin_page')->with('status', 'error')->with('message', 'Update failed');
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

    // Fungsi untuk mengunggah gambar cover baru
    private function uploadNewCoverImage($request, $novel)
    {
        $file = $request->file('fileToUpload');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->move('uploads', $filename, 'public');
        $novel->cover_image = $filename;
    }
}
