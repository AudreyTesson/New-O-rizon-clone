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
        $dqlQuery = 'SELECT c FROM App\Entity\City c ORDER BY c.name ' . $order;
        
        $query = $this->entityManager->createQuery($dqlQuery);
        $sortedCities = $query->getResult();
        
        return $sortedCities;
    }
}