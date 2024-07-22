<?php

namespace App\Contracts;

interface ItemContract {
    public function getUrl(): string;
    public function getTitle(): string;
}