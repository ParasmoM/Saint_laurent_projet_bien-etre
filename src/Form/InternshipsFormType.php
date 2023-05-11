<?php

namespace App\Form;

use App\Entity\Internships;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternshipsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('rate')
            ->add('additionalInformation')
            ->add('start_date')
            ->add('end_date')
            ->add('display_from_date')
            ->add('display_until_date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Internships::class,
        ]);
    }
}
