<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\Country;
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
     * Display cities of the country searched
     */
    public function FindCitiesByCountry($searchCountry)
    {

        return $this->createQueryBuilder('c')                  //c = city
                    ->join('c.country', 'co')           // co= country
                    ->andWhere("co.name LIKE :countryName")
                    ->setParameter("countryName", '%'.$searchCountry.'%')
                    ->getQuery()
                    ->getResult();

        // $entityManager = $this->getEntityManager();

        // $countryId = $country->getId();

        // $query = $entityManager->createQuery("
        //     SELECT city, country
        //     FROM app\Entity\City city
        //     JOIN city.country country
        //     WHERE city.country = $countryId
        //     GROUP BY country.id
        //     ORDER BY country.name ASC
        // ");

        // $result = $query->getResult();

        // return $result;
    }
    
    //! Method for testing homepage 
    /**
     * Select 50 cities
     *
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
