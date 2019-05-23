<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 23-5-2019
 * Time: 12:22
 */

namespace AppBundle\Form;


class AcountType
{
    // App\Form\AccountType

    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$builder
->add('oldPassword', PasswordType::class, array(
'mapped' => false
))
->add('plainPassword', RepeatedType::class, array(
'type' => PasswordType::class,
'invalid_message' => 'Les deux mots de passe doivent être identiques',
'options' => array(
'attr' => array(
'class' => 'password-field'
)
),
'required' => true,
))
->add('submit', SubmitType::class, array(
'attr' => array(
'class' => 'btn btn-primary btn-block'
)
))
;
}