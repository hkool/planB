<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReceptType extends AbstractType
{
    /**
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('kostenPerLiter')
            ->add('fruit',EntityType::class,[
                'class'=>'AppBundle:Fruit',
                'choice_label'=>'naam' //veld uit tabel
                ])
            ->add('bereidingswijze');
    }
    /**
     *
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recept'
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
