<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Currency>
 *
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

   /**
    * @return Currency[] Returns an array of Currency objects
    */
   public function getListOfCurrencyByVisibility($value): array
   {
       return $this->createQueryBuilder('Currency')
           ->andWhere('Currency.visible = :visibleParam')
           ->setParameter('visibleParam', $value)
           ->orderBy('Currency.currency_name', 'ASC')
           ->getQuery()
           ->getArrayResult()
       ;
   }

}
