<?php

namespace App;

use App\Interfaces\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements BaseModel
{
    private $id;
    private $boo_title;
    private $boo_author;
    private $boo_bookstore;

    public function table_name()
    {
        return 'books';
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getTitle() { return $this->boo_title; }
    public function setTitle($boo_title) { $this->boo_title = $boo_title; }

    public function getAuthor() { return $this->boo_author; }
    public function setAuthor(Author $boo_author) { $this->boo_author = $boo_author; }

    public function getBookstore() { return $this->boo_bookstore; }
    public function setBookstore(Bookstore $boo_bookstore) { $this->boo_bookstore = $boo_bookstore; }

}
