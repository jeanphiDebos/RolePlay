<?php

namespace App\Repository;

use App\Entity\Whisper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Whisper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Whisper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Whisper[]    findAll()
 * @method Whisper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WhisperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Whisper::class);
    }
}
