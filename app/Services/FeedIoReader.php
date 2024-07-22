<?php

namespace App\Services;

use FeedIo\FeedIo;
use App\Contracts\ReaderContract;
use App\DataTransfertObjects\ReaderItem;

class FeedIoReader implements ReaderContract {
    public function __construct(
        protected FeedIo $feedIo,
    ){}

    /** @return array<ItemInterface> */
    public function fetch(string $url): array
    {
        $result = $this->feedIo->read($url);

        $items = [];

        foreach($result->getFeed() as $item) {
            $items[] = new ReaderItem($item->getLink(), $item->getTitle());
        }

        return $items;
    }
}