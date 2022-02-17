<?php

namespace App\Repository;

use App\Entity\PathfinderBestiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PathfinderBestiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method PathfinderBestiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method PathfinderBestiary[]    findAll()
 * @method PathfinderBestiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PathfinderBestiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PathfinderBestiary::class);
    }
}
