<?php

namespace App\Filter;

interface FilterInterface
{
    public function apply(string $url): bool;
}