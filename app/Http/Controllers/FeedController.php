<?php

namespace App\Http\Controllers;

use FeedIo\FeedIo;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(FeedIo $feedIo)
    {
        $url = 'https://laravel-france.com/rss';

        $result = $feedIo->read($url);

        $feeds = [];

        foreach ($result->getFeed() as $item) {
            $feeds[] = [
                'url' => $item->getLink(), 
                'title' => $item->getTitle(),
            ];
        }

        return response()->json($feeds);
    }
}
