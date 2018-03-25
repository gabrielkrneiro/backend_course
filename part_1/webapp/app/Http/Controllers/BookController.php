<?php

namespace App\Http\Controllers;

use App\AuthorSearch;
use App\BookSearch;
use App\BookstoreSearch;
use App\Catalog;
use App\CatalogSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BookController extends Controller
{
    private static function searchModel()
    {
        return new BookSearch();
    }

    private static function searchModelAuthor()
    {
        return new AuthorSearch();
    }

    private static function searchModelBookstore()
    {
        return new BookstoreSearch();
    }

    public function index()
    {
        $dataProvider = self::searchModel()->getBooks();
        return view('book.index')->with('dataProvider',$dataProvider);
    }

    public function details($id)
    {
        $book = self::searchModel()->getBooks($id);
//        $result = self::searchModel()->book_author('http://localhost:3000/api/books/1/author');
//        dd($result);
        return view('book.details')->with('book',$book);
    }

    public function insert()
    {
        $bookstores = self::searchModelBookstore()->getBookstores();
        $authors = self::searchModelAuthor()->getAuthors();
        return view('book.insert')->with(
            [
                'authors' => $authors,
                'bookstores' => $bookstores
            ]
        );
    }

    public function addBook()
    {
        $form = Input::get();
        $result = self::searchModel()->addBook($form);
        return redirect()->action('BookController@index');
    }

    public function removeBook($id)
    {
        $result = self::searchModel()->removeAuthor($id);
        return redirect()->action('BookController@index');
    }

    public function update($id)
    {
        $book = self::searchModel()->getBooks($id);
        $authors = self::searchModelAuthor()->getAuthors();
        $bookstores = self::searchModelBookstore()->getBookstores();
        return view('book.update')->with([
            'book' => $book,
            'authors' => $authors,
            'bookstores' => $bookstores
        ]);
    }

    public function updateBook()
    {
        $form = Input::get();
        $result = self::searchModel()->updateBook($form);
        return redirect()->action('BookController@index');
    }
}
