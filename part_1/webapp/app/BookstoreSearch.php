<?php

namespace App;

use Error;
use GuzzleHttp\Client;
use http\Exception;
use Illuminate\Database\Eloquent\Model;

class BookstoreSearch extends Bookstore implements BaseUrl
{
    public function base_url()
    {
        return Connection::base_url().$this->table_name().'/';
    }

    public function getBookstores($params=null)
    {
        try {
            $json_array = $this->http_request('GET', $this->base_url(), $params);

            if(gettype($json_array) == gettype([]))
            {
                $objects_array = [];
                foreach($json_array as $item)
                {
                    $bookstore = new Bookstore();
                    $bookstore->setId($item->id);
                    $bookstore->setName($item->books_name);
                    $bookstore->setAddress($item->books_address);
                    $objects_array [] = $bookstore;
                }
                return $objects_array;
            }
            else
            {
                $bookstore = new Bookstore();
                $bookstore->setId($json_array->id);
                $bookstore->setName($json_array->books_name);
                $bookstore->setAddress($json_array->books_address);
                return $bookstore;
            }
        }
        catch(\Exception $exception)
        {
            return new Error('{"error":'.$exception->getCode().'}');
        }
    }

    public function addBookstore($params=null)
    {
        try
        {
            self::http_request('POST',$this->base_url(),$params);
            return true;
        }
        catch(\Exception $exception)
        {
            return new Error('{"error":'.$exception->getCode().'}');
        }

    }

    public function removeBookstore($params)
    {
        try
        {
            self::http_request('DELETE',$this->base_url(),$params);
            return true;
        }catch(\Exception $exception)
        {
            return new Error('{"error":'.$exception->getCode().'}');
        }
    }

    public function updateBookstore($params)
    {
        try
        {
            self::http_request('PUT',$this->base_url(),$params);
            return true;
        }catch(\Exception $exception){
            return new Error('{"error":'.$exception->getCode().'}');
        }
    }

    private static function http_client()
    {
        return new Client();
    }

    public function http_request($method, $url, $params)
    {
        switch ($method)
        {
            case 'GET':
                $result = self::http_client()->get($url.$params);
                return json_decode($result->getBody()->getContents());
                break;
            case 'POST':
                $result = self::http_client()->post($url,[
                    'form_params' => [
                        'books_name' => $params['books_name'],
                        'books_address' => $params['books_address']
                    ]
                ]);
                return $result;
                break;
            case 'DELETE':
                $result = self::http_client()->delete($url.$params);
                return $result;
                break;
            case 'PUT':
                $result = self::http_client()->put($url.$params['books_id'],[
                    'form_params' => [
                        'books_name' => $params['books_name'],
                        'books_address' => $params['books_address']
                    ]
                ]);
                return $result;
                break;
        }
    }
}
