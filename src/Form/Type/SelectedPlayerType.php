<?php

namespace App\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Player;
use App\Entity\User;

class SelectedPlayerType extends AbstractType
{
    /**
     * @var User $user
     */
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'selectedPlayer',
                EntityType::class,
                [
                    'class'         => Player::class,
                    'label'         => 'selected_player',
                    'query_builder' => function (EntityRepository $er) {
                        $qb = $er->createQueryBuilder('p');
                        $qb->leftJoin('p.user', 'u');
                        $qb->addSelect('u');
                        $qb->where($qb->expr()->eq('u', ':u'));
                        $qb->setParameter('u', $this->user);
                        return $qb;
                    },
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'validate']
            );
    }
}
