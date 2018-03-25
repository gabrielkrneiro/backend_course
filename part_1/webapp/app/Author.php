<?php

namespace App;

use App\Interfaces\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Author extends Model implements BaseModel
{
    private $id;
    private $aut_name;

    public function table_name()
    {
        return 'authors';
    }

    public function getId() { return $this->id; }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->aut_name;
    }

    /**
     * @param mixed $aut_name
     */
    public function setName($aut_name)
    {
        $this->aut_name = $aut_name;
    }




}
