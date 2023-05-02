<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CategoriesOfServices;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ServicesFixtures extends Fixture
{
    private $tabCategories = [
        'Massage',
        'Nutritionniste',
        'Yoga',
        'Esthéticienne',
        'Coach sportive',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->tabCategories as $category) {
            $this->createCategory($category, $manager);
        }

        $manager->flush();
        
        $categoriesRepository = $manager->getRepository(CategoriesOfServices::class);
        $categ = $categoriesRepository->findAll();

        $randomIndex = array_rand($categ);
        $randomCategory = $categ[$randomIndex];

        $randomCategory->setFeatured(true);
        $manager->persist($randomCategory);
        $manager->flush();
    }

    public function createCategory($nom, ObjectManager $manager) {
        $faker = Factory::create('fr_BE');
        
        $categories = new CategoriesOfServices();
        $categories->setName($nom);
        $categories->setDescription($faker->sentences(10, true));
        $manager->persist($categories);
    }
}
