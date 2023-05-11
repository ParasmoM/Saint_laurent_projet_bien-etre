<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            // ->add('password')
            ->add('addressStreet')
            ->add('adressNumber')
            // ->add('registration')
            // ->add('userType')
            // ->add('failedAttempts')
            // ->add('banned')
            // ->add('isVerified')
            // ->add('internetUsers')
            // ->add('providers')
            ->add('town')
            ->add('locality')
            ->add('postalCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
