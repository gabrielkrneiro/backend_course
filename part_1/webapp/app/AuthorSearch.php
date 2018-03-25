<?php

namespace App;

use Error;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AuthorSearch extends Author implements BaseUrl
{
    public function base_url()
    {
        return Connection::base_url().$this->table_name().'/';
    }

    private static function http_client()
    {
        return $client = new Client();
    }

    public function getAuthors($params=null)
    {
        try
        {
            $result = $this->http_request('GET',$this->base_url(),$params);
            if (gettype($result) == gettype([]))
            {
                $array_authors_obj = [];
                foreach($result as $item)
                {
                    $author = new Author();
                    $author->setId($item->id);
                    $author->setName($item->aut_name);
                    array_push($array_authors_obj,$author);
                }
                return $array_authors_obj;
            }
            else
            {
                $author = new Author();
                $author->setId($result->id);
                $author->setName($result->aut_name);
                return $author;
            }
        }
        catch(\Exception $exception)
        {
            return new Error('{"error":'.$exception->getCode().'}');
        }
    }

    public function insertAuthor(Author $author)
    {
        try{
            $this->http_request('POST',$this->base_url(),$author->getName());
            return redirect('author/index');
        }catch(\Exception $exception){
            return json_encode(['error' => 'could not get any content']);
        }
    }

    public function removeAuthor($id)
    {
        try{
            $this->http_request('DELETE',$this->base_url(),$id);
            return true;
        }catch(\Exception $exception){
            return json_encode(['error' => 'could not remove the author']);
        }
    }

    public function updateAuthor($array)
    {
        $result = $this->http_request('UPDATE',$this->base_url(),$array);
        if($result)
        {
            return true;
        }else{
            return 'erro';
        }
    }

    public function http_request($method,$url,$params)
    {
        switch ($method)
        {
            case 'GET':
                    if($params == null)
                    {
                        $result = self::http_client()->request($method,$url);
                    }
                    else
                    {
                        $result = self::http_client()->request($method,$url.$params);
                    }
                    $json_object = $result->getBody()->getContents();
                    return json_decode($json_object);
                break;
            case 'POST':
                $result = self::http_client()->request($method,$url,[
                    'form_params' => [
                        'aut_name' => $params
                    ]
                ]);
                return $result;
                break;
            case 'DELETE':
                $result = self::http_client()->delete($url.$params);
                return $result;
                break;
            case 'UPDATE':
                $result = self::http_client()->patch($url.$params['author_id'],[
                    'form_params' => [
                        'aut_name' => $params['author_name']
                    ]
                ]);
                return $result;
                break;
            default:
                return false;
                break;
        }
    }



}
