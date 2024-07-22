<?php

namespace App\Contracts;

use App\Contracts\ItemInterface;

interface ReaderContract {
    /** @return array<ItemInterface> */
    public function fetch(string $url): array;
}