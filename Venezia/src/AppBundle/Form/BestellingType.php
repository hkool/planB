<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-4-2019
 * Time: 15:20
 */

namespace AppBundle\Form;

use AppBundle\Entity\Bestelling;
use AppBundle\Entity\Recept;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('afhaaldatum', DateType::class,[
                'years'=>range(19,29)])
            ->add('klant',TextType::class)
            ->add('telefoon', TextType::class)
//            ->add('bestelregels', BestelregelType::class, [
//                'label'=>'naam',
//                'data_class'=>null
//            ])
            ->add('bestelregels', CollectionType::class, [
               'entry_type' => BestelregelType::class,
               'entry_options' => ['label' => false],
               'by_reference' => false,
               'allow_add' => true,
               'allow_delete' => true,])
            ->add('save',SubmitType::class,[
                'label'=>"Opslaan"
            ])
            ->add('save',SubmitType::class,[
                'label'=>"Opslaan"
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bestelling::class,
        ]);
    }
}