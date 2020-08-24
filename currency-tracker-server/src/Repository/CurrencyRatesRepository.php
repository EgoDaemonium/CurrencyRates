<?php

namespace App\Repository;

use App\Entity\CurrencyRates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CurrencyRates|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrencyRates|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrencyRates[]    findAll()
 * @method CurrencyRates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencyRates::class);
    }

    public function transform(CurrencyRates $currencyRate)
    {
        return [
                'id'    => (int) $currencyRate->getId(),
                'currency' => (string) $currencyRate->getCurrency(),
                'rate' => (double) $currencyRate->getRate(),
                'recordDate' => $currencyRate->getRecordDate()
        ];
    }
    

    public function transformAll()
    {
        $currencyRates = $this->findAll();
        $currencyRatesArray = [];

        foreach ($currencyRates as $currencyRate) {
            $currencyRatesArray[] = $this->transform($currencyRate);
        }

        return $currencyRatesArray;
    }

    // //using this terrible code, because findBy method is not working for me..
    // function isName($var, )
    // {
    //     // является ли переданное число нечетным
    //     return $var['currency'];
    // }

    public function findByCurrencyName($value)
    {
        $currencyRates = $this->findAll();
        $currencyRates = $this->findBy(['currency' => "$value"], ['recordDate' => 'DESC']);
        
        $currencyRatesArray = [];

        foreach ($currencyRates as $currencyRate) {
            $currencyRatesArray[] = $this->transform($currencyRate);
        }

        return $currencyRatesArray;
        
        // return $this->createQueryBuilder('c')
        //     ->andWhere('c.currency = :val')
        //     ->setParameter('val', $value)
        //     ->orderBy('c.recordDate', 'ASC')
        //     // ->setMaxResults(10)
        //     ->getQuery()
        //     ->getResult()
        // ;
    }

    /*
    public function findOneBySomeField($value): ?CurrencyRates
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
