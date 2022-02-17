<?php

namespace App\Repository;

use App\Entity\PathfinderPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PathfinderPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method PathfinderPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method PathfinderPlayer[]    findAll()
 * @method PathfinderPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PathfinderPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PathfinderPlayer::class);
    }
}
