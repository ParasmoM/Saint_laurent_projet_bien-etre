<?php

namespace App\Form;

use App\Entity\Internships;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InternshipsFormType extends AbstractType
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
            ->add('rate')
            ->add('additionalInformation')
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
        ;
        $builder->get('end_date')->setData(new \DateTime());
        $builder->get('display_from_date')->setData(new \DateTime());
        $builder->get('display_until_date')->setData(new \DateTime());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Internships::class,
        ]);
    }
}
