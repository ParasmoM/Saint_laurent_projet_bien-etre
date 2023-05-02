<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ImagesFixtures extends Fixture
{
    private $imgCateg = [
        'Massage' => 'Massage.avif',
        'Nutritionniste' => 'Nutritionniste.avif',
        'Yoga' => 'Yoga.avif',
        'Esthéticienne' => 'Esthéticienne.avif',
        'Coach sportive' => 'Coach sportive.avif',
    ];

    public function load(ObjectManager $manager): void
    {
        $this->imageCateg($this->imgCateg, $manager);
    }

    public function imageCateg($tab, $manager) {
        foreach($tab as $category => $imageNom) {

            $imageCateg = new Images();
            $categoriesRepository = $manager->getRepository(Categories::class);
    
            $categ = $categoriesRepository->findOneBy(['nom' => $category]);
    
            $imageCateg->setCategorie($categ);
            $imageCateg->setNom($imageNom);
    
            $manager->persist($imageCateg);
            $manager->flush();

        }
    }
}
