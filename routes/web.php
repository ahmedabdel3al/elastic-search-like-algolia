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
use Illuminate\Http\Request;

Route::get('/search', function (Request $request) {
    $elatic = new Elastic;
    return response()->json(['data' => $elatic->search($request->q, new Post()), 'count' => count($elatic->search($request->q, new Post()))]);
});

Auth::routes();

Route::resource('posts', 'PostController')->only('index', 'show');
