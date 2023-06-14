<?php

namespace App\Repository;

use App\Data\FilterData;
use App\Entity\City;
use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<City>
 *
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function add(City $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(City $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Retrieve data from database with criteria passed in filter form
     *
     * @param FilterData $filerData
     * @return array
     */
    public function findByFilter(FilterData $filterData)
    {
         $query = $this->createQueryBuilder('city')
            ->select('city', 'c')
            ->join('city.country', 'c');

            if (!empty($filterData->electricityLevel)) {
                $query = $query
                    ->andWhere('city.electricity LIKE :filterData')
                    ->setParameter("filterData", "%$filterData->electricityLevel%");
            }

            if (!empty($filterData->temperatureMin)) {
                $query = $query
                    ->andWhere('city.temperatureAverage >= :temperatureMin')
                    ->setParameter('temperatureMin', $filterData->temperatureMin);
            }

            if (!empty($filterData->temperatureMax)) {
                $query = $query
                    ->andWhere('city.temperatureAverage <= :temperatureMax')
                    ->setParameter('temperatureMax', $filterData->temperatureMax);
            }

            if (!empty($filterData->visaRequired)) {
                $query = $query
                    ->andWhere('city.visaRequired = 1');
            }

          return $query->getQuery()
                ->getResult();
    }

    /**
     * Method test to retrieve a part of city data to render in Homepage
     *
     * @return void
     */
    public function findByCityLimit50()
    {
        return $this->createQueryBuilder('city')
                    ->select("city")
                    ->setMaxResults(50)
                    ->getQuery()
                    ->getResult();
    }

    
//    /**
//     * @return City[] Returns an array of City objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?City
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
