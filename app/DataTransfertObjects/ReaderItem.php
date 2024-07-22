<?php

namespace App\DataTransfertObjects;

use App\Contracts\ItemContract;

class ReaderItem implements ItemContract
{
    public function __construct(
        private string $url,
        private string $title,
    ){}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}