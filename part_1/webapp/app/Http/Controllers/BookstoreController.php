<?php

namespace App\Http\Controllers;

use App\Bookstore;
use App\BookstoreSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BookstoreController extends Controller
{
    private static function searchModel()
    {
        return new BookstoreSearch();
    }

    public function index()
    {
        //$dataProvider = self::searchModel()->getBookstores(1);
        $dataProvider = self::searchModel()->getBookstores();
        return view('bookstore.index')->with(['dataProvider' => $dataProvider]);
    }

    public function details($id)
    {
        $bookstore = self::searchModel()->getBookstores($id);
        return view('bookstore.details')->with(['bookstore' => $bookstore]);
    }

    public function insert()
    {
        $bookstore = new Bookstore();
        return view('bookstore.insert')->with(['bookstore' => $bookstore]);
    }

    public function addBookstore()
    {
        $form = Input::get();
        self::searchModel()->addBookstore($form);
        return redirect()->action('BookstoreController@index');
    }

    public function removeBookstore($id)
    {
        self::searchModel()->removeBookstore($id);
        return redirect()->action('BookstoreController@index');
    }

    public function update($id)
    {
        $bookstore = self::searchModel()->getBookstores($id);
        return view('bookstore.update')->with(['bookstore' => $bookstore]);
    }

    public function updateBookstore()
    {
        $form = Input::get();
        self::searchModel()->updateBookstore($form);
        return redirect()->action('BookstoreController@index');
    }


}
