<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingType extends AbstractType
{
    /**
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('klantnaam')
            ->add('telefoon')
            ->add('bestelregel',CollectionType::class,[
                'class'=>'AppBundle:BestelregelType',
                'choice_label'=>'id' //veld uit tabel
                ])
            ->add('afhaaldatum', DateType::class);
    }
    /**
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bestelling'
        ));
    }

    /**
     *
     */
    public function getBlockPrefix()
    {
        return 'appbundle_recept';
    }


}
