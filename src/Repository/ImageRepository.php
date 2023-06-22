<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Lexer;
/**
 * @extends ServiceEntityRepository<Image>
 *
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function add(Image $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Image $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Display 1 image per city for 30 cities, in the carousel for mobile version => retrieve only city name
     *
     */
    public function findByDistinctCityImage()
        {
              $entityManager = $this->getEntityManager();

              $query = $entityManager->createQuery("
                    SELECT image.url AS imageUrl, image.id AS imageId, city.name AS cityName, city.id AS cityId, country.name AS countryName, country.id AS countryId
                    FROM App\Entity\Image image
                    JOIN image.country country
                    JOIN image.city city
                    GROUP BY city.id
                  ");

              $query  ->setMaxResults(30);

              $result = $query->getResult();

              return $result;
        }

}
