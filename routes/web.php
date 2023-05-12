<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/timeline/{date?}', function ($date = null) {
    return view('timeline', ['date'=>$date]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
//Route::get('/storage/{filename}', [App\Http\Controllers\ImageController::class, 'show'])->where('filename', '^[^/]+$');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/storage/images/{filename}', function ($filename) {
//     $path = storage_path('app/public/images/' . $filename);

//     if (!Storage::exists($path)) {
//         abort(404);
//     }

//     $file = Storage::get($path);
//     $type = Storage::mimeType($path);

//     return Response::make($file, 200, ['Content-Type' => $type]);
// })->where('filename', '.*');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
