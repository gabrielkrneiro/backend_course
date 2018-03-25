<?php

namespace App;

use App\Interfaces\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model implements BaseModel
{
    private $id;
    private $book;
    private $bookstore;

    public function table_name()
    {
        return 'catalogs';
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBook()
    {
        return $this->book;
    }
    public function setBook(Book $book)
    {
        $this->book = $book;
    }

    public function getBookstore()
    {
        return $this->bookstore;
    }
    public function setBookstore(Bookstore $bookstore)
    {
        $this->bookstore = $bookstore;
    }


}
