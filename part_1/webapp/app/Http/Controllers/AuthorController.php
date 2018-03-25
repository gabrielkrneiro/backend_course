<?php
namespace App\Http\Controllers;

use App\AuthorSearch;
use App\Http\Controllers\Controller;
use App\Author;
use http\Exception;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends Controller
{
    private static function searchModel()
    {
        return new AuthorSearch();
    }

    public function index()
    {
        $dataProvider = self::searchModel()->getAuthors();
        return view('author/index')->with('dataProvider',$dataProvider);
    }

    public function insert()
    {
        return view('author/insert');
    }

        public function update($id)
    {
        $searchModel = new AuthorSearch();
        $author = $searchModel->getAuthors($id);
        return view('author/insert')->with('author',$author);
    }

        public function addAuthor()
    {
        $form = Input::get();
        $author = new Author();
        $author->setName($form['author_name']);
        try{
            self::searchModel()->insertAuthor($author);
            return redirect()->action('AuthorController@index');
        }catch(Exception $exception){
            return 'error....';
        }
    }

    public function removeAuthor($id)
    {
        $author = new AuthorSearch();
        $result = $author->removeAuthor($id);
        if($result) {
            return redirect()->action('AuthorController@index');
        }
        else
        {
           return 'error in updating...';
        }
    }

    public function updateAuthor()
    {
        $form = Input::get();
        self::searchModel()->updateAuthor($form);
        return redirect()->action('AuthorController@index');

    }

    public function details($id)
    {
        $author = self::searchModel()->getAuthors($id);
        return view('author/details')->with('author',$author);
    }


}