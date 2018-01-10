<?php
namespace App\BenbenLand\Services;

use GuzzleHttp\Client;

class QiNiuService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function imageInfo($url)
    {
        $response = $this->httpClient->get($url.'?imageInfo');
        return json_decode($response->getBody());
    }
}
