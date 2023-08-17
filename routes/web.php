<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

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

Route::get('/', function () {
    // to only see blogs of the logged in user
    $posts = [];
    if(auth()->check()){
        $posts = auth()->user()->userposts()->latest()->get();
    }
    // $posts = Post::where('user_id', auth()->id())->get();
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// posts related routes
Route::post('/create-post', [PostsController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostsController::class, 'showeditscreen']);
Route::put('/edit-post/{post}', [PostsController::class, 'update']);
Route::delete('/delete-post/{post}', [PostsController::class, 'deletePost']);
