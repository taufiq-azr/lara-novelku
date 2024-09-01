<?php

use App\Http\Controllers\NovelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateNovelController;
use App\Http\Controllers\DeleteNovelController;
use App\Http\Controllers\EditNovelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [NovelController::class, 'index'])->name('index');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin-page', [AdminController::class, 'adminPage'])->name('admin.admin_page');
    Route::post('/create_novel', [CreateNovelController::class, 'store'])->name('post_novel');
    Route::put('/edit_novel', [EditNovelController::class, 'update'])->name('edit_novel');
    Route::delete('/novel/{id}', [DeleteNovelController::class, 'delete'])->name('delete_novel');
    Route::get('/admin-page/users', [UserController::class, 'UsersPage'])->name('admin.users');
    Route::post('/create_users', [UserController::class, 'storeUser'])->name('post_user');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('delete_user');
    Route::put('/edit_user', [UserController::class, 'update'])->name('edit_users');
    Route::get('/admin-page/chapters', [ChapterController::class, 'ChaptersPage'])->name('admin.chapters');
    Route::post('/create_chapter', [ChapterController::class, 'storeChapters'])->name('post_chapter');
    Route::delete('/chapter/{chapter_id}', [ChapterController::class, 'delete'])->name('delete_chapter');
    Route::put('/edit_chapter', [ChapterController::class, 'update'])->name('edit_chapter');
});

// Novel Routes
Route::get('/novels/{novel}', [NovelController::class, 'show'])->name('show');
Route::get('/chapter/{chapter}', [ChapterController::class, 'showDetail'])->name('chapter_detail');
