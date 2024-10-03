<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findAllBurgers()
    {
        return $this->findAll();
    }

    public function findBurgersWithIngredient(string $ingredient){
        $qb = $this->createQueryBuilder('p')
            ->join('p.oignon', 'o')
            ->join('p.Sauce', 's')

            ->where('o.name = :ingredient or s.name = :ingredient')

            ->setParameter('ingredient', $ingredient);

        return $qb->getQuery()->getResult();
    }


    public function findTopXBurgers(int $limit){
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.price', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

    public function findBurgersWithoutIngredient(string $ingredient){
        $qb = $this->createQueryBuilder('b')
        ->join('b.Sauce','s')
        ->join('b.pain','p')
        ->join('b.oignon','o')
        ->where("s.name != :ingredient and p.name != :ingredient and o.name != :ingredient")
        ->setParameter('ingredient', $ingredient);

        return $qb->getQuery()->getResult();
    }

    public function findBurgersWithMinimumIngredients(int $minIngredients){
        $qb = $this->createQueryBuilder('b')
        ->join('b.Sauce', 's')
        ->join('b.pain', 'p')
        ->join('b.oignon', 'o')
        ->groupBy('b.id')
        ->having('COUNT(s.name) + COUNT(p.name) + COUNT(o.name) >= :minIngredients')
        ->setParameter('minIngredients', $minIngredients);

        return $qb->getQuery()->getResult();
    }   

}
