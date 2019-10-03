<?php

namespace App\Repository;

use App\Entity\FieldBestiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FieldBestiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method FieldBestiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method FieldBestiary[]    findAll()
 * @method FieldBestiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldBestiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FieldBestiary::class);
    }
}
