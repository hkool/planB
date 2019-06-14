<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestelregelType extends AbstractType
{
    /**
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recept', EntityType::class,
                ['class=>AppBundle:Recept',
                    'choice_label'=>'naam'])
            ->add('aantal');

    }
    /**
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bestelregel'
        ));
    }

    /**
     *
     */
    public function getBlockPrefix()
    {
        return 'appbundle_bestelregel';
    }


}
