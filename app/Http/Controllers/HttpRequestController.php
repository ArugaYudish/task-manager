<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HttpRequestController extends Controller
{
    public function fetchData()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/1');
        $data = json_decode($response->getBody()->getContents(), true);

        return view('data', ['data' => $data]);
    }
}
