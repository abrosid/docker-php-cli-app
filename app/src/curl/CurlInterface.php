<?php

namespace Blog\Curl;


class CurlInterface
{
    const URL = "https://jsonplaceholder.typicode.com/";

    private $params;
    private $path;



    public function __construct(array $params)
    {
        $this->params = implode('/', $params);
        $this->path = self::URL . $this->params;
    }


    public function getPath() : string
    {
        return $this->path;
    }


    private function onCall()
    {
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }
    }



    public function call()
    {
        $cSession = curl_init($this->path); 
        //step2
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_HEADER, false); 
        //step3
        $result = curl_exec($cSession);
        //step4
        curl_close($cSession);
        //step5
        return json_decode($result);

    }

}