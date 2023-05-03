<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Images;
use App\Entity\Providers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private $faker;

    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
        $this->faker = $faker = Factory::create('fr_BE');
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->createProvider(10, 'femme', $manager);
    }

    public function createProvider($nbr, $sexe, $manager) {
        $faker = Factory::create('fr_BE');

        for($user = 1; $user <= $nbr; $user++) {
            // Nouveau Prestataire
            $prestataire = new Providers();
            $prestataire->setLastName($faker->lastName);
            $prestataire->setFirstName($faker->firstName($sexe));
            
            // On crée 10 services pour le prestataire
            // $this->createPromotion($prestataire, $manager);

            // on crée un stage 
            // $this->createStage($prestataire, $manager);

            // On l'associer une image de profil 
            $this->createImageProfile($prestataire, $sexe, $manager);

            // Nouveau Utilisateur 
            $this->createUsers($prestataire, $manager);
            
            $manager->flush();
        }
    }

    public function createImageProfile($prestataire, $sexe, $manager) {
        $tabFemmes = [
            'Femme_Africaine_01.avif',
            'Femme_Africaine_02.avif',
            'Femme_Africaine_03.avif',
            'Femme_Africaine_04.avif',
            'Femme_Africaine_05.avif',
            'Femme_Africaine_06.avif',
            'Femme_Africaine_07.avif',
            'Femme_Africaine_08.avif',
            'Femme_Africaine_09.avif',
            'Femme_Africaine_10.avif',
            'Femme_Asiatique_01.avif',
            'Femme_Asiatique_02.avif',
            'Femme_Asiatique_03.avif',
            'Femme_Asiatique_04.avif',
            'Femme_Asiatique_05.avif',
            'Femme_Asiatique_06.avif',
            'Femme_Asiatique_07.avif',
            'Femme_Asiatique_08.avif',
            'Femme_Asiatique_09.avif',
            'Femme_Asiatique_10.avif',
            'Femme_Caucasien_01.avif',
            'Femme_Caucasien_02.avif',
            'Femme_Caucasien_03.avif',
            'Femme_Caucasien_04.avif',
            'Femme_Caucasien_05.avif',
            'Femme_Caucasien_06.avif',
            'Femme_Caucasien_07.avif',
            'Femme_Caucasien_08.avif',
            'Femme_Caucasien_09.avif',
            'Femme_Caucasien_10.avif',
            'Femme_Metisse_01.avif',
            'Femme_Metisse_02.avif',
            'Femme_Metisse_03.avif',
            'Femme_Metisse_04.avif',
            'Femme_Metisse_05.avif',
            'Femme_Metisse_06.avif',
            'Femme_Metisse_07.avif',
            'Femme_Metisse_08.avif',
            'Femme_Metisse_09.avif',
            'Femme_Metisse_10.avif',
        ];

        // Sélectionnez une image aléatoire
        $randomImage = $this->faker->randomElement($tabFemmes);

        // Créez et enregistrez une nouvelle entité Images
        $photo = new Images();
        $photo->setName($randomImage);
        $photo->setProviderPhoto($prestataire);
        $manager->persist($photo);

        $prestataire->addImage($photo);
    }

    public function createUsers($prestataire, $manager) {
        $user = new Users();
        $user->setEmail($this->faker->email);
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'azertyui') 
        );
        $user->setRoles(['ROLE_USER', 'ROLE_PROVIDER']);
        $user->setUserType('Provider');
        $user->setFailedAttempts(0);
        $user->setBanned(false);
        $user->setProviders($prestataire);

        $manager->persist($user);
    }
}
