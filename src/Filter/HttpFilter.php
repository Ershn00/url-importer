<?php

namespace App\Filter;

class HttpFilter implements FilterInterface
{
    public function apply(string $url): bool
    {
        return (str_contains($url, 'http'));
    }
}