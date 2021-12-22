<?php

namespace App\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Universe;

class SelectedUniverseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'selectedUniverse',
                EntityType::class,
                [
                    'class'         => Universe::class,
                    'label'         => 'selected_universe',
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'validate']
            );
    }
}
