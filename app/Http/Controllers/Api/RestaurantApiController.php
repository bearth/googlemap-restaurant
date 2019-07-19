<?php

namespace App\Http\Controllers\Api;

use Cache;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class RestaurantApiController extends Controller
{
    public function __construct()
    {
        // create new client with base uri
        $this->client = new Client(['base_uri' => 'https://maps.googleapis.com/maps/api/place/']);
    }

    public function search(Request $request)
    {
        // store query string parameter "query" in a variable
        $query = $request->input('query');
        // retrieve cached restaurants data
        $data = $this->retrieveCachedData($query);
        // return data to client in json format
        return response()->json([
            'data' => $data
        ]);
    }

    private function retrieveCachedData($query)
    {
        // define cache expiry time in minutes
        $minutes = 15;
        // define cache key
        $key = 'restaurant-' . $query;
        /* 
        retrieve cached data from key if there are any,
        otherwise make new request and store data in cache with key
        */
        return Cache::remember($key, $minutes, function () use ($query) {
            return $this->requestGoogleMapApi($query);
        });
    }

    private function requestGoogleMapApi($query)
    {
        // wrap api request in try catch in case there are any errors
        try {
            // make api request
            $response = $this->client->get('textsearch/json', [
                'query' => [
                    'key' => config('googlemap.api_key'),
                    'type' => 'restaurant',
                    'query' => $query
                ]
            ]);
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
        // get body from response
        $body = $response->getBody();
        // decode json body to array format
        $data = json_decode($body, true);
        // return data to be cached
        return $data['results'] ?? [];
    }
}
