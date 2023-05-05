<?php

namespace App\DataFixtures;

use App\Entity\Localities;
use App\Utils\Adresse;
use App\Entity\PostalCodes;
use App\Entity\Towns;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach(Adresse::getPostalcodes() as $code) {
            $postalCode = new PostalCodes();

            $postalCode->setName($code);
            $manager->persist($postalCode);
        }

        foreach(Adresse::getLocalities() as $locality) {
            $localities = new Localities();

            $localities->setName($locality);
            $manager->persist($localities);
        }

        foreach(Adresse::getTowns() as $town) {
            $towns = new Towns();

            $towns->setName($town);
            $manager->persist($towns);
        }

        $manager->flush();
    }
}
