<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class CatalogSearch extends Catalog implements BaseUrl
{
    public function base_url()
    {
        return Connection::base_url().$this->table_name().'/';
    }

    private static function http_client()
    {
        return $client = new Client();
    }

    public function addCatalog()
    {
        return 'asdfasdfasd';
    }

    public function http_request($method, $url, $params)
    {
        // TODO: Implement http_request() method.
    }
}
