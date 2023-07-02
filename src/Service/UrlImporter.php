<?php

namespace App\Service;

use App\Entity\Url;
use App\Filter\FilterInterface;
use Doctrine\ORM\EntityManagerInterface;

class UrlImporter
{
    private EntityManagerInterface $entityManager;
    private FilterInterface $filter;

    public function __construct(EntityManagerInterface $entityManager, FilterInterface $filter)
    {
        $this->entityManager = $entityManager;
        $this->filter = $filter;
    }

    public function importURLs(array $urls): void
    {
        foreach ($urls as $url) {
            if ($this->filter->apply($url)) {
                $urlEntity = new URL();
                $urlEntity->setUrl($url);

                $this->entityManager->persist($urlEntity);
            }
        }

        $this->entityManager->flush();
    }
}