<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationFieldType extends AbstractType
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
            ->add('description', TextType::class, [
                'label' => 'label.description',
                'required' => false
            ])
            ->add('type', EntityType::class, [
                'label' => 'label.type',
                'class' => 'AppBundle\Entity\ConfigurationFieldType',
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
            'data_class' => 'AppBundle\Entity\ConfigurationField'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_configurationfield';
    }


}
