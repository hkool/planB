<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-4-2019
 * Time: 15:20
 */

namespace AppBundle\Form;

use AppBundle\Entity\Fruit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FruitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image',FileType::class, [
                'label'=>'Afbeelding alleen jpeg, jpg',
                'data'=>null
            ])
            ->add('naam')
            ->add('seizoen',ChoiceType::class,
                ['choices'=>  [
                    'jaar'=>'jaar',
                    'lente'=>'lente',
                    'zomer'=>'zomer',
                    'herfst'=>'herfst',
                    'winter'=>'winter',
                    ]
        ])
            ->add('save',SubmitType::class,[
                'label'=>"Opslaan"
            ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fruit::class,
        ]);
    }

}