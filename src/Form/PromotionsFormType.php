<?php

namespace App\Form;

use App\Entity\Promotions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PromotionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'input-titre'
                ]
            ])
            ->add('description', null, [
                'attr' => [
                    'class' => 'input-textarea'
                ]
            ])
            ->add('documentPdf', FileType::class, [
                'label' => 'Exporter un PDF',
                'mapped' => false,
                'required' => false,
            ])
            // ->add('start_date')
            ->add('end_date')
            // ->add('display_from_date')
            // ->add('display_until_date')
            ->add('providers')
            ->add('service')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotions::class,
        ]);
    }
}
