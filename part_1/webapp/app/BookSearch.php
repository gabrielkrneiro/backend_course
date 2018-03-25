<?php

namespace App;

use Couchbase\Exception;
use Error;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class BookSearch extends Book implements BaseUrl
{
    public function base_url()
    {
        return Connection::base_url().$this->table_name().'/';
    }

    private static function http_client()
    {
        return new Client();
    }

    private static function author()
    {
        return '/author';
    }

    private static function bookstore_tablename()
    {
        return '/bookstores';
    }

    private static function bookstore_client()
    {
        return new BookstoreSearch();
    }

    private static function author_client()
    {
        return new AuthorSearch();
    }

    public function getBooks($params=null)
    {
        try
        {
            $result = $this->http_request('GET',$this->base_url(),$params);
            if(gettype($result) == gettype([]))
            {
                $book_array = [];
                foreach($result as $object)
                {
                    //fetch who are book`s author
                    $author = $this->book_author($this->base_url().$object->id.self::author());
                    $bookstore = $this->book_bookstore($this->base_url().$object->id.self::bookstore_tablename());

                    //dd($bookstore);

                    $book = new Book();
                    $book->setId($object->id);
                    $book->setTitle($object->boo_title);
                    $book->setAuthor($author);
                    $book->setBookstore($bookstore);

                    $book_array [] = $book;
                }

                return $book_array;
            }
            else
            {
                $book_author = $this->book_author($this->base_url().$params.self::author());
                $bookstore = $this->book_bookstore($this->base_url().$params.self::bookstore_tablename());
                $book = new Book();
                $book->setId($result->id);
                $book->setTitle($result->boo_title);
                $book->setAuthor($book_author);
                $book->setBookstore($bookstore);
                return $book;
            }
        }
        catch(\Exception $exception)
        {
            return new Error('{"error":'.$exception->getMessage().'}');
        }
    }

    public function book_author($url)
    {
        $response = json_decode(self::http_client()
            ->get($url)
            ->getBody()
            ->getContents()
        );
        $author = new Author();
        $author->setId($response->id);
        $author->setName($response->aut_name);
        return $author;
    }

    public function book_bookstore($url)
    {
        $response = json_decode(self::http_client()
            ->get($url)
            ->getBody()
            ->getContents()
        );
        $bookstore = new Bookstore();
        $bookstore->setId($response[0]->id);
        $bookstore->setName($response[0]->books_name);
        $bookstore->setAddress($response[0]->books_address);
        return $bookstore;

    }

    public function addBook($params)
    {
        //post: http://localhost:3000/api/bookstores/{bookstore_id}/books
        
        $result = $this->http_request('POST',
            Connection::base_url().self::bookstore_client()->table_name().'/'.$params['boo_bookstore'].'/'.self::table_name(),
            $params
        );
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function removeAuthor($params)
    {
        $result = $this->http_request('DELETE',$this->base_url(),$params);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getMyBookstore($params)
    {
        $url = $this->base_url().$params['boo_id'].'/'.self::bookstore_client()->table_name();
        $json = self::http_client()->get($url)->getBody()->getContents();
        $response = json_decode($json)[0];
        $bookstore = self::bookstore_client()->getBookstores($response->id);
        return $bookstore;
    }

    public function updateBook($params)
    {
        //tem que pegar o objeto atual no banco pra depois somente pegar a qual catalogo ele pertence e entao atualizar
        //da foram correta.

        $result = $this->http_request('PUT',$this->base_url(),$params);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function http_request($method,$url,$params)
    {
        switch ($method)
        {
            case 'GET':
                $result = self::http_client()->get($url.$params);
                $json_object = $result->getBody()->getContents();
                return json_decode($json_object);
                break;

            case 'POST':
                $result = self::http_client()->post($url,[
                    'form_params' => [
                        'boo_title' => $params['boo_title'],
                        'boo_aut_id' => $params['boo_author']
                    ]
                ]);
                return $result;
                break;

            case 'DELETE':
                $bookstore_response = json_decode(self::http_client()->get($url.$params.'/bookstores')->getBody()->getContents())[0]->id;
                $bookstore = self::bookstore_client()->getBookstores($bookstore_response);
                self::http_client()->delete($url.$params.self::bookstore_tablename().'/rel/'.$bookstore->getId());
                $result = self::http_client()->delete($url.$params);
                return $result;
                break;

            case 'PUT':
                $book = $this->getBooks($params['boo_id']);
                self::http_client()->delete($this->urlCatalog($book));
                self::http_client()->put($this->urlCatalog($book,$params['boo_bookstore']),
                [
                    'form_params' => [
                        "book_id" => $params['boo_id'],
                        "books_id" => $params['boo_bookstore']
                    ]
                ]);
                
                $result = self::http_client()->put($url.$params['boo_id'],[
                    'form_params' => [
                        'boo_title' => $params['boo_title'],
                        'boo_aut_id' => $params['boo_author']
                    ]
                ]);
                return $result;
                break;
            default:
                break;
        }
    }


    private function urlCatalog($book,$bookstore = null)
    {
        $bookstore_id = ($bookstore)?$bookstore:$book->getBookstore()->getId();

        return $this->base_url().$book->getId()
        .'/'.self::bookstore_client()->table_name().'/rel/'.$bookstore_id;
    }

}