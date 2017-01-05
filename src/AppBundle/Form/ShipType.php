<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShipType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'label.name',
                'required' => true
            ])
            ->add('picture', TextType::class, [
                'label' => 'label.picture',
                'required' => false
            ])
            ->add('playerShip', ChoiceType::class, array(
                'label' => 'label.playerShip',
                'choices' => array(
                    'label.yes' => true,
                    'label.no' => false
                ),
                'required' => true
            ))
            ->add('crew', IntegerType::class, [
                'label' => 'label.crew',
                'required' => true
            ])
            ->add('shell', IntegerType::class, [
                'label' => 'label.shell',
                'required' => true
            ])
            ->add('canon', IntegerType::class, [
                'label' => 'label.canon',
                'required' => true
            ])
            ->add('cannonball', IntegerType::class, [
                'label' => 'label.cannonball',
                'required' => true
            ])
            ->add('type', EntityType::class, [
                'label' => 'label.type',
                'class' => 'AppBundle\Entity\ShipType',
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true
            ])
            ->add('universe', EntityType::class, [
                'label' => 'label.universe',
                'class' => 'AppBundle\Entity\Universe',
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ship'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ship';
    }


}
