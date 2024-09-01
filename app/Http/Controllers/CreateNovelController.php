<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novels;

class CreateNovelController extends Controller
{
    public function store(Request $request)
    {
        $this->validateInput($request);

        $filename = $this->uploadFile($request);

        $novel = $this->createNovel($request, $filename);

        return $this->redirectWithStatus($novel);
    }

    private function validateInput(Request $request)
    {
        $request->validate([
            'nama_novel' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'fileToUpload' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
    }

    private function uploadFile(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $toUpload = 'uploads';
            $file = $request->file('fileToUpload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move($toUpload, $filename, 'public');
            return $filename;
        }
        return null;
    }

    private function createNovel(Request $request, $filename)
    {
        $novel = new Novels();
        $novel->title = $request->input('nama_novel');
        $novel->genre = $request->input('genre');
        $novel->status = $request->input('status');
        $novel->description = $request->input('deskripsi');
        $novel->cover_image = $filename;
        $novel->save();
        return $novel;
    }

    private function redirectWithStatus($novel)
    {
        if ($novel) {
            return redirect()->route('admin.admin_page')->with('status', 'success');
        } else {
            return redirect()->route('admin.admin_page')->with('status', 'error');
        }
    }
}
