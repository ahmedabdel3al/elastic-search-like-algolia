<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }
    public function getPosts(Request $request)
    {
        $posts = Post::query();
        if ($request->has('sort')) {
            $sort = explode(',', $request->sort);
            $posts->orderBy($sort[0], $sort[1]);
        }

        return response()->json(['posts' => $posts->paginate($request->per_page), 'columns' => [['label' => 'Title', 'field' => 'title'], ['label' => 'Body', 'field' => 'body'],  ['label' => 'ID', 'field' => 'id']]]);
    }
}
