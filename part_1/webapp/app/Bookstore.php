<?php

namespace App;

use App\Interfaces\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Bookstore extends Model implements BaseModel
{
    private $id;
    private $books_name;
    private $books_address;

    function table_name()
    {
        return 'bookstores';
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->books_name; }
    public function setName($books_name) { $this->books_name = $books_name; }

    public function getAddress() { return $this->books_address; }
    public function setAddress($books_address) { $this->books_address = $books_address; }
}
