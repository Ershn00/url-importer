<?php

namespace App\Filter;

use App\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;

readonly class DuplicateUrlFilter implements FilterInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function apply(string $url): bool
    {
        $urlRepository = $this->entityManager->getRepository(Url::class);
        $existingUrl = $urlRepository->findOneBy(['url' => $url]);

        return $existingUrl === null;
    }
}