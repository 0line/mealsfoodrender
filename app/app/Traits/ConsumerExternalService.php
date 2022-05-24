<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumerExternalService
{
    /**
     * Send a request to any service
     * @return string
     */

    public function performRequest($method, $requestUrl, $data = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $response = $client->request($method, $requestUrl, ['json' => $data['params'], 'headers' => $headers]);
        return $response;
    }
}
