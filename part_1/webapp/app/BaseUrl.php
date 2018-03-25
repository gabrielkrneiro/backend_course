<?php
/**
 * Created by PhpStorm.
 * User: gabri
 * Date: 12/01/2018
 * Time: 13:44
 */

namespace App;


interface BaseUrl
{
    public function base_url();
    public function http_request($method,$url,$params);
}