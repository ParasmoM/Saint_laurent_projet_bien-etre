<?php

namespace App\Form;

use App\Utils\Utils2;
use App\Model\SearchData;
use App\Repository\CategoriesOfServicesRepository;
use App\Repository\CommuneRepository;
use App\Repository\LocaliteRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CodePostalRepository;
use App\Repository\LocalitiesRepository;
use App\Repository\PostalCodesRepository;
use App\Repository\TownsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchType extends AbstractType
{
    public function __construct(
        // private Utils2 $utils2,
        private EntityManagerInterface $entityManager,
        private CategoriesOfServicesRepository $categoriesRepository,
        private TownsRepository $townsRepository,
        private LocalitiesRepository $localitiesRepository,
        private PostalCodesRepository $postalCodesRepository
    ) {}

    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Qui recherchez-vousn ? ...'
                ],
                'required' => false, // Rend le champ non obligatoire
                'empty_data' => '', // Rend le champ nullable
            ])
            ->add('service', ChoiceType::class, [
                'choices' => $this->tabChoices('categoriesRepository'),
                'placeholder' => '',
                'required' => false, // Rend le champ non obligatoire
                // 'empty_data' => '', // Rend le champ nullable
            ])
            ->add('code', ChoiceType::class, [
                'choices' => $this->tabChoices('postalCodesRepository'),
                'placeholder' => '',
                'required' => false, // Rend le champ non obligatoire
                // 'empty_data' => '', // Rend le champ nullable
            ])
            ->add('town', ChoiceType::class, [
                'choices' => $this->tabChoices('townsRepository'),
                'placeholder' => '',
                'required' => false, // Rend le champ non obligatoire
                // 'empty_data' => '', // Rend le champ nullable
            ])
            ->add('locality', ChoiceType::class, [
                // 'choices' => $choices['localiteRepository'],
                'placeholder' => '',
                'required' => false, // Rend le champ non obligatoire
                // 'empty_data' => '', // Rend le champ nullable
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function tabChoices($methodName): array
    {
        $choices = [];
        $tab = [];

        $repository = $this->{$methodName};
        $entities = $repository->findAll();
        
        foreach ($entities as $val) {
            $tab[] = $val->getName();
        }
            
        $entityChoices = array_combine($tab, $tab);
        
        return $entityChoices;
    }
}