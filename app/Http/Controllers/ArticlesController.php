<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Rendering page with data
     *
     * @param  int  $id
     * @return View
     */
    public function __invoke($id)
    {
        $client = new \App\JsonRpc\Client(env('JSON_RPC_SERVER'),env('JSON_RPC_SERVER_TOKEN'));
        $response = $client->getArticles(['page_uid'=> $id]);

        $articles = $response->isSuccess() ? $response->getResult() : [];

        return view('articles', ['page_id' => $id, 'articles' => $articles]);
    }
}
