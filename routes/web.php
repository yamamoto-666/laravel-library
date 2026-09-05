<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home'); 

####author####  
#author homepage
Route::get('/author/index',[AuthorController::class, 'index'])->name('author.index');
#author store
Route::post('/author/store',[AuthorController::class, 'store'])->name('author.store');
#author edit
Route::get('/author/{id}/edit',[AuthorController::class, 'edit'])->name('author.edit');
#author update
Route::patch('/author/{id}/update', [AuthorController::class, 'update'])->name('author.update');
#author delete
Route::delete('/author/{id}/destroy', [AuthorController::class, 'destroy'])->name('author.destroy');


####book route####
#book homepage
Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
#show book
Route::get('/book/{id}/show', [BookController::class, 'show'])->name('book.show');
#edit book
Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
#update book
Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');
#delete page
Route::get('/book/{id}/delete', [BookController::class, 'delete'])->name('book.delete');
#destroy
Route::delete('/book/{id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');
});

