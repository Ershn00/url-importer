<?php

namespace App\Service;

use App\Entity\Url;
use App\Filter\FilterChain;
use Doctrine\ORM\EntityManagerInterface;

class UrlImporter
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly FilterChain            $filterChain,
        private int                             $importedCount = 0
    )
    {
    }

    public function importURLs(array $urls): int
    {
        foreach ($urls as $url) {
            if ($this->filterChain->apply($url)) {
                $urlEntity = new URL();
                $urlEntity->setUrl($url);

                $this->entityManager->persist($urlEntity);
                $this->importedCount ++;
            }
        }

        $this->entityManager->flush();

        return $this->importedCount;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }
}