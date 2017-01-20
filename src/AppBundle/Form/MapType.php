<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapType extends AbstractType
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
            ->add('picture', FileType::class, [
                'label' => 'label.picture',
                'required' => true,
                'data_class' => null
            ])
            ->add('display', ChoiceType::class, array(
                'label' => 'label.display',
                'choices' => array(
                    'label.yes' => true,
                    'label.no' => false
                ),
                'required' => true
            ))
            ->add('verticalAxis', IntegerType::class, [
                'label' => 'label.vertical_axis',
                'required' => true
            ])
            ->add('horizontalAxis', IntegerType::class, [
                'label' => 'label.horizontal_axis',
                'required' => true
            ])
            ->add('displayType', EntityType::class, [
                'label' => 'label.display_type',
                'class' => 'AppBundle\Entity\DisplayType',
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
            'data_class' => 'AppBundle\Entity\Map'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_map';
    }


}
