<?php

namespace App\Service;

use App\Entity\Url;
use App\Filter\FilterChain;
use Doctrine\ORM\EntityManagerInterface;

readonly class UrlImporter
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private FilterChain $filterChain
    )
    {
    }

    public function importURLs(array $urls): void
    {
        foreach ($urls as $url) {
            if ($this->filterChain->apply($url)) {
                $urlEntity = new URL();
                $urlEntity->setUrl($url);

                $this->entityManager->persist($urlEntity);
            }
        }

        $this->entityManager->flush();
    }
}