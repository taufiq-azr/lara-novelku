<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Novel;
use App\Models\Chapters;
use App\Models\Novels;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function index()
    {
        
        $novels = Novels::orderBy('updated_at', 'DESC')->get();
        return view('index', ['novels' => $novels]);
    }

    public function show($novel_id)
    {
        $chapters = Chapters::where('novel_id', $novel_id)->orderBy('chapter_number')->get();
        $novels = Novels::findOrFail($novel_id);
        return view('show', compact('novels', 'chapters'));
    }
}
