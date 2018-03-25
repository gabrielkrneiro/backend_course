<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', "HomepageController@index");

/*
 * Author
 * */
Route::get('/author', 'AuthorController@index');
Route::get('/author/insert', 'AuthorController@insert');
Route::post('/author/addAuthor', 'AuthorController@addAuthor');
Route::get('/author/remove/{id}', 'AuthorController@removeAuthor');
Route::get('/author/update/{id}', 'AuthorController@update');
Route::post('/author/updateAuthor', 'AuthorController@updateAuthor');
Route::get('/author/details/{id}', 'AuthorController@details');

/*
 * Book
 * */
Route::get('/book', 'BookController@index');
Route::get('/book/details/{id}', 'BookController@details');
Route::get('/book/insert', 'BookController@insert');
Route::post('/book/addBook', 'BookController@addBook');
Route::get('/book/remove/{id}', 'BookController@removeBook');
Route::get('/book/update/{id}', 'BookController@update');
Route::post('/book/updateBook', 'BookController@updateBook');

/*
 * Bookstore
 * */
Route::get('/bookstore', 'BookstoreController@index');
Route::get('/bookstore/details/{id}', 'BookstoreController@details');
Route::get('/bookstore/insert', 'BookstoreController@insert');
Route::post('/bookstore/addBookstore', 'BookstoreController@addBookstore');
Route::get('/bookstore/remove/{id}', 'BookstoreController@removeBookstore');
Route::get('/bookstore/update/{id}', 'BookstoreController@update');
Route::post('/bookstore/updateBookstore', 'BookstoreController@updateBookstore');

Route::get('/{any}', function($any){
    return redirect('/');
})->where('any', '.*');