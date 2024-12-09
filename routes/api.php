<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// get all posts no need to authenticate
Route::post('/all/posts', [PostController::class, 'getAllPosts']);
// get single post no need to authenticate
Route::post('/single/post/{post_id}', [PostController::class, 'getPost']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    // blog api
    Route::post('/add/post', [PostController::class, 'addNewPost']);
    // edit approach 1
    Route::post('/edit/post', [PostController::class, 'editPost']);
    // edit approach 2
    Route::post('/edit/post/{post_id}', [PostController::class, 'editPost2']);
    // delete post
    Route::post('/delete/post/{post_id}', [PostController::class, 'deletePost']);

    // comment
    Route::post('/comment', [CommentController::class, 'postComment']);
    // like
    Route::post('/like', [LikeController::class, 'likePost']);
});
