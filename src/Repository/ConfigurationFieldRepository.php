<?php

namespace App\Repository;

use App\Entity\ConfigurationField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ConfigurationField|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfigurationField|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfigurationField[]    findAll()
 * @method ConfigurationField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigurationFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConfigurationField::class);
    }
}
