<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function otherPlayersToCurrentPlayer(Player $player)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->leftJoin('p.universe', 'u');
        $qb->addSelect('u');
        $qb->where($qb->expr()->eq('u', ':u'));
        $qb->andWhere($qb->expr()->neq('p.id', ':currentPlayer'));
        $qb->setParameters(
            [
                'u' => $player->getUniverse(),
                'currentPlayer' => $player->getId(),
            ]
        );

        return $qb->getQuery()->getResult();
    }
}
