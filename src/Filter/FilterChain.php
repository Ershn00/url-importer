<?php

namespace App\Filter;

use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Contracts\Service\ServiceSubscriberTrait;

class FilterChain implements FilterInterface, ServiceSubscriberInterface
{
    use ServiceSubscriberTrait;

    private array $filters;

    public function __construct(HttpFilter $httpFilter, DuplicateUrlFilter $duplicateUrlFilter)
    {
        $this->filters = [$httpFilter, $duplicateUrlFilter];
    }

    public function apply(string $url): bool
    {
        foreach ($this->filters as $filter) {
            if (!$filter->apply($url)) {
                return false;
            }
        }

        return true;
    }
}