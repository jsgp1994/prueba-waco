<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestController extends Controller
{
    public function makeGetRequest($uri, $method)
    {
        $body = null;
        $status_code = 200;
        $error_message = '';
        try {
            $client = new Client();
            $response = $client->request($method, $uri);
            $status_code = $response->getStatusCode();
            $body = json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {

            $error_message = $e->getMessage();
            if ($e->hasResponse()) {
                $status_code = $e->getResponse()->getStatusCode();
                $response_body = $e->getResponse()->getBody()->getContents();
                $error_message .= "\nResponse Status Code: $status_code\nResponse Body: $response_body";
            }
        }

        return [
            'status_code' => $status_code,
            'response_body' => $body,
            'error_message' => $error_message
        ];
    }
}
