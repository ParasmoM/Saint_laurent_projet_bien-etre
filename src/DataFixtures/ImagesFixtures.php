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
        $this->populateImages($manager, $this->imgCateg);
        $this->populateImages($manager, 150);
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

    public function populateImages(ObjectManager $manager, $data): void
    {        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $image = new Images();
                
                $categoriesRepository = $manager->getRepository(CategoriesOfServices::class);
                $service = $categoriesRepository->findOneBy(['name' => $key]);
                
                $image->setServiceImage($service);
                $image->setName($value);

                $manager->persist($image);
            }
            $manager->flush();
        }
        if (is_numeric($data)) {
            for ($i=1; $i <= $data; $i++) { 
                $image = new Images();
                $image->setName($i . '.avif');
                
                $manager->persist($image);
            }
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
