<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestiaryType extends AbstractType
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
                'required' => true
            ])
            ->add('hide', ChoiceType::class, array(
                'label' => 'label.hide',
                'choices' => array(
                    'label.yes' => true,
                    'label.no' => false
                ),
                'required' => true
            ))
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
            'data_class' => 'AppBundle\Entity\Bestiary'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_bestiary';
    }


}
