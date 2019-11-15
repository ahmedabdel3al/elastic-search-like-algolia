<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Elastic\Elastic;
use App\Post;
use Elasticsearch\Client;
use Illuminate\Http\Request;

Route::get('elastic-match', function (Client $client) {
    $params = [
        'index' => 'elastic-posts',
    ];
    $response = $client->indices()->getMapping($params);
    return $response;
});
Route::get('set-mapping', function (Client $client) {
    $params = [
        'index' => 'elastic-posts',
        'type' => 'posts',
        'body' => [
            '_source' => [
                'enabled' => true
            ],
            'properties' => [
                'created_at' => [
                    "type" => "date",
                ]
            ]
        ]
    ];
    $response = $client->indices()->putMapping($params);
});
