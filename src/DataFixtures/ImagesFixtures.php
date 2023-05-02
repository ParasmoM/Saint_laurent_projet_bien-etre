<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\CategoriesOfServices;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    private $imgCateg = [
        'Massage' => 'Massage.avif',
        'Nutritionniste' => 'Nutritionniste.avif',
        'Yoga' => 'Yoga.avif',
        'Esthéticienne' => 'Esthéticienne.avif',
        'Coach sportive' => 'Coach.avif',
    ];

    public function load(ObjectManager $manager): void
    {
        $this->imageCateg($this->imgCateg, $manager);
    }

    public function imageCateg($tab, $manager) {
        foreach($tab as $category => $imageNom) {

            $imageCateg = new Images();
            $categoriesRepository = $manager->getRepository(CategoriesOfServices::class);
    
            $categ = $categoriesRepository->findOneBy(['name' => $category]);
    
            $imageCateg->setServiceImage($categ);
            $imageCateg->setName($imageNom);
    
            $manager->persist($imageCateg);
            $manager->flush();

        }
    }

    public function getDependencies()
    {
        return [
            ServicesFixtures::class,
        ];
    }
}
