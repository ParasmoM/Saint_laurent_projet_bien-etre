<?php

namespace App\Form;

use App\Entity\Promotions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PromotionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
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
            ->add('end_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('display_from_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('display_until_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('providers')
            ->add('service')
        ;
        $builder->get('end_date')->setData(new \DateTime());
        $builder->get('display_from_date')->setData(new \DateTime());
        $builder->get('display_until_date')->setData(new \DateTime());
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotions::class,
        ]);
    }
}
