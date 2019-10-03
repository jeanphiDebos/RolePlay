<?php

namespace App\Repository;

use App\Entity\FieldPlayer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FieldPlayer|null find($id, $lockMode = null, $lockVersion = null)
 * @method FieldPlayer|null findOneBy(array $criteria, array $orderBy = null)
 * @method FieldPlayer[]    findAll()
 * @method FieldPlayer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldPlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FieldPlayer::class);
    }
}
