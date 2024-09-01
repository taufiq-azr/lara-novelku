<?php

namespace App\Http\Controllers;

use App\Models\Chapters;
use App\Models\Novels;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function ChaptersPage()
    {
        // Ambil semua chapters dan novels dari database
        $chapters = Chapters::all();
        $novels = Novels::all();

        // Buat associative array untuk novel_id ke title
        $novelTitles = $novels->pluck('title', 'novel_id')->toArray();

        // Tampilkan halaman admin dengan data chapters dan novelTitles
        return view('admin.chapters', compact('chapters', 'novels', 'novelTitles'));
    }
    public function showDetail($chapter_id)
    {
        // Ambil data chapter berdasarkan $chapter_id
        $chapter = Chapters::findOrFail($chapter_id);

        // Ambil novel yang terkait dengan bab yang dipilih
        $novels = Novels::findOrFail($chapter->novel_id);

        // Mengambil ID bab pertama


        // Kemudian, kembalikan tampilan detail bab beserta informasi novel yang terkait
        return view('chapter_detail', compact('chapter', 'novels'));
    }

    public function storeChapters(Request $request)
    {

        // Buat chapter baru
        $chapter = new Chapters();
        $chapter->novel_id = $request->input('novels_id');
        $chapter->title = $request->input('judul-chapters');
        $chapter->content = $request->input('konten-chapters');
        $chapter->chapter_number = $request->input('chapter_number');
        $chapter->save();
        // Redirect dengan pesan sukses
        if ($chapter->save()) {
            return redirect()->route('admin.chapters')->with('status', 'success');
        } else {
            // Tampilkan pesan kesalahan jika gagal menyimpan perubahan
            return redirect()->route('admin.chapters')->with('status', 'error')->with('message', 'Update failed');
        }
    }

    public function delete($chapter_id)
    {
        // Temukan user berdasarkan $id
        $chapter = Chapters::findOrFail($chapter_id);

        if ($chapter) {
            $chapter->delete();
            return redirect()->route('admin.chapters')->with('status', 'success');
        } else {
            return redirect()->route('admin.chapters')->with('status', 'error')->with('message', 'Update failed');
        }



        // Redirect ke halaman tertentu atau kirim respons JSON atau yang lainnya jika perlu
    }

    public function update(Request $request)
    {
        // Lakukan validasi data dari $request jika diperlukan
        $chapter_id = $request->input('chapter-modal-id');
        if (!$chapter_id) {
            return redirect()->route('admin.chapters')->with('status', 'error')->with('message', 'Chapter ID not found');
        }

        // Temukan chapter berdasarkan ID yang diberikan dalam $request
        $chapter = Chapters::findOrFail($chapter_id);
        if (!$chapter) {
            return redirect()->route('admin.chapters')->with('status', 'error')->with('message', 'Chapter not found');
        }

        // Atur atribut-atribut chapter berdasarkan data dari $request
        $chapter->novel_id = $request->input('chapters-modal-novel_id');
        $chapter->title = $request->input('chapters-modal-judul');
        $chapter->content = $request->input('chapters-modal-content');
        $chapter->chapter_number = $request->input('chapters-modal-chapter_number');
        $chapter->save();
        // Simpan perubahan pada chapter ke dalam database
        if ($chapter->save()) {
            return redirect()->route('admin.chapters')->with('status', 'success');
        } else {
            // Tampilkan pesan kesalahan jika gagal menyimpan perubahan
            return redirect()->route('admin.chapters')->with('status', 'error')->with('message', 'Update failed');
        }
    }
}
        // Redirect ke halaman tertentu atau kirim respons JSON atau yang lainnya jika perlu
