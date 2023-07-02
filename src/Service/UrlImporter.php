<?php

namespace App\Service;

use App\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;

class UrlImporter
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importURLs(array $urls): void
    {
        foreach ($urls as $url) {
            $urlEntity = new URL();
            $urlEntity->setUrl($url);

            $this->entityManager->persist($urlEntity);
        }

        $this->entityManager->flush();
    }
}