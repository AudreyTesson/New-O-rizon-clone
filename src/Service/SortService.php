<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class SortService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sortCitiesByName(string $order = 'asc'): array
    {
        $query = $this->entityManager->createQuery("
        SELECT image, city
        FROM App\Entity\Image image
        JOIN image.city city
        WHERE image.id IN (
            SELECT MIN(cityImage.id)
            FROM App\Entity\Image cityImage
            WHERE cityImage.city = city
            GROUP BY cityImage.city
        )
        ORDER BY city.name " . strtoupper($order)
        );

        $sortedCities = $query->getResult();

        return $sortedCities;
    }
}