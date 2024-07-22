<?php

namespace App\Console\Commands;

use App\Contracts\ReaderContract;
use FeedIo\FeedIo;
use App\Models\Post;
use App\Services\Reader;
use Dotenv\Repository\Adapter\ReaderInterface;
use Illuminate\Console\Command;

class FetchPostsUsingFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-posts-using-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ReaderContract $reader)
    {
        $items = $reader->fetch('https://laravel-france.com/rss');

        foreach($items as $item) {
            Post::query()->updateOrCreate(['url' => $item->getUrl()], ['title' => $item->getTitle()]);
        }
    }
}
