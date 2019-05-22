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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\FormBuilderInterface;

class ReceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('prijsPerLiter',MoneyType::class)
            ->add('bereidingswijze',TextareaType::class)
            ->add('fruit',EntityType::class,
                ['class'=>Fruit::class,
                'choice_label'=>'naam'])
            ->add('save',SubmitType::class,[
                'label'=>"Opslaan"
            ]);
    }
}