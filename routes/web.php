<?php

use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Author\AuthorCommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFavoriteController;
use App\Http\Controllers\Author\AuthorFavoriteController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Author\AuthorSettingsController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Author\AuthorDashboardController;
use App\Http\Controllers\Author\PostController;
use App\Http\Controllers\AuthorController as FeAuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController as FePostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('posts', [FePostController::class, 'index'])->name('post.index');
Route::get('post/{slug}', [FePostController::class, 'details'])->name('post.details');

Route::get('/category/{slug}', [FePostController::class, 'postByCategory'])->name('category.posts');
Route::get('/tag/{slug}', [FePostController::class, 'postByTag'])->name('tag.posts');

Route::get('profile/{username}', [FeAuthorController::class, 'profile'])->name('author.profile');

Route::post('subscriber', [SubscriberController::class, 'store'])->name('subscriber.store');

Route::get('search', [SearchController::class, 'search'])->name('search');

Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', [FavoriteController::class, 'add'])->name('post.favorite');
    Route::post('comment/{post}', [CommentController::class, 'store'])->name('comment.store');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [AdminSettingsController::class, 'index'])->name('settings');
    Route::put('profile-update', [AdminSettingsController::class, 'updateProfile'])->name('profile.update');
    Route::put('password-update', [AdminSettingsController::class, 'updatePassword'])->name('password.update');

    Route::resource('tag', AdminTagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', AdminPostController::class);

    Route::get('pending/post', [AdminPostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve', [AdminPostController::class, 'approval'])->name('post.approve');

    Route::get('favorite', [AdminFavoriteController::class, 'index'])->name('favorite.index');

    Route::get('authors', [AuthorController::class, 'index'])->name('author.index');
    Route::delete('authors/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

    Route::get('comments', [AdminCommentController::class, 'index'])->name('comment.index');
    Route::delete('comments/{id}', [AdminCommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('subscriber', [AdminSubscriberController::class, 'index'])->name('subscriber.index');
    Route::delete('subscriber/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscriber.destroy');

    Route::get('search', [SearchController::class, 'search'])->name('search');
});
Route::group(['as' => 'author.', 'prefix' => 'author', 'middleware' => 'author'], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [AuthorSettingsController::class, 'index'])->name('settings');
    Route::put('profile-update', [AuthorSettingsController::class, 'updateProfile'])->name('profile.update');
    Route::put('password-update', [AuthorSettingsController::class, 'updatePassword'])->name('password.update');

    Route::get('favorite', [AuthorFavoriteController::class, 'index'])->name('favorite.index');
    Route::get('comments', [AuthorCommentController::class, 'index'])->name('comment.index');
    Route::delete('comments/{id}', [AuthorCommentController::class, 'destroy'])->name('comment.destroy');

    Route::resource('post', PostController::class);
});
View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Models\Category::all();
    $view->with('categories', $categories);
});
