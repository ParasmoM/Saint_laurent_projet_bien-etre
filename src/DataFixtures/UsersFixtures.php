<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Images;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    // public function createImageProfil($prestataire, $sexe, $manager) {
    //     $tabFemmes = [
    //         'Femme_Africaine_01.avif',
    //         'Femme_Africaine_02.avif',
    //         'Femme_Africaine_03.avif',
    //         'Femme_Africaine_04.avif',
    //         'Femme_Africaine_05.avif',
    //         'Femme_Africaine_06.avif',
    //         'Femme_Africaine_07.avif',
    //         'Femme_Africaine_08.avif',
    //         'Femme_Africaine_09.avif',
    //         'Femme_Africaine_10.avif',
    //         'Femme_Asiatique_01.avif',
    //         'Femme_Asiatique_02.avif',
    //         'Femme_Asiatique_03.avif',
    //         'Femme_Asiatique_04.avif',
    //         'Femme_Asiatique_05.avif',
    //         'Femme_Asiatique_06.avif',
    //         'Femme_Asiatique_07.avif',
    //         'Femme_Asiatique_08.avif',
    //         'Femme_Asiatique_09.avif',
    //         'Femme_Asiatique_10.avif',
    //         'Femme_Caucasien_01.avif',
    //         'Femme_Caucasien_02.avif',
    //         'Femme_Caucasien_03.avif',
    //         'Femme_Caucasien_04.avif',
    //         'Femme_Caucasien_05.avif',
    //         'Femme_Caucasien_06.avif',
    //         'Femme_Caucasien_07.avif',
    //         'Femme_Caucasien_08.avif',
    //         'Femme_Caucasien_09.avif',
    //         'Femme_Caucasien_10.avif',
    //         'Femme_Metisse_01.avif',
    //         'Femme_Metisse_02.avif',
    //         'Femme_Metisse_03.avif',
    //         'Femme_Metisse_04.avif',
    //         'Femme_Metisse_05.avif',
    //         'Femme_Metisse_06.avif',
    //         'Femme_Metisse_07.avif',
    //         'Femme_Metisse_08.avif',
    //         'Femme_Metisse_09.avif',
    //         'Femme_Metisse_10.avif',
    //     ];
    //     $tabHommes = [
    //         'Homme_Africain_01.avif',
    //         'Homme_Africain_02.avif',
    //         'Homme_Africain_03.avif',
    //         'Homme_Africain_04.avif',
    //         'Homme_Africain_05.avif',
    //         'Homme_Africain_06.avif',
    //         'Homme_Africain_07.avif',
    //         'Homme_Africain_08.avif',
    //         'Homme_Africain_09.avif',
    //         'Homme_Africain_10.avif',
    //         'Homme_Asiatique_01.avif',
    //         'Homme_Asiatique_02.avif',
    //         'Homme_Asiatique_03.avif',
    //         'Homme_Asiatique_04.avif',
    //         'Homme_Asiatique_05.avif',
    //         'Homme_Asiatique_06.avif',
    //         'Homme_Asiatique_07.avif',
    //         'Homme_Asiatique_08.avif',
    //         'Homme_Asiatique_09.avif',
    //         'Homme_Asiatique_10.avif',
    //         'Homme_Caucasien_01.avif',
    //         'Homme_Caucasien_02.avif',
    //         'Homme_Caucasien_03.avif',
    //         'Homme_Caucasien_04.avif',
    //         'Homme_Caucasien_05.avif',
    //         'Homme_Caucasien_06.avif',
    //         'Homme_Caucasien_07.avif',
    //         'Homme_Caucasien_08.avif',
    //         'Homme_Caucasien_09.avif',
    //         'Homme_Caucasien_10.avif',
    //         'Homme_Metisse_01.avif',
    //         'Homme_Metisse_02.avif',
    //         'Homme_Metisse_03.avif',
    //         'Homme_Metisse_04.avif',
    //         'Homme_Metisse_05.avif',
    //         'Homme_Metisse_06.avif',
    //         'Homme_Metisse_07.avif',
    //         'Homme_Metisse_08.avif',
    //         'Homme_Metisse_09.avif',
    //         'Homme_Metisse_10.avif',
    //     ];

    //     $imagesRepository = $manager->getRepository(Images::class);
    //     $tabImages = $imagesRepository->findAll();

    //     do {
    //         // Sélectionnez le tableau en fonction de la valeur de $type
    //         $selectedArray = ($sexe == 'femme') ? $tabFemmes : $tabHommes;

    //         // Sélectionnez une image aléatoire
    //         $randomImage = $this->faker->randomElement($selectedArray);
    //         $index = array_search($randomImage, $selectedArray);
    //         array_splice($tabFemmes, $index, 1);
        
    //         $imageExists = false;
    //         foreach ($tabImages as $image) {
    //             if ($image->getName() === $randomImage) {
    //                 $imageExists = true;
    //                 break;
    //             }
    //         }
    //         // La boucle recommencera si l'image existe déjà et s'il reste des images
    //     } while ($imageExists && !empty($tabFemmes));
        
    //     // Créez et enregistrez une nouvelle entité Images
    //     $photo = new Images();
    //     $photo->setName($randomImage);
    //     $photo->setPrestataire($prestataire);
    //     $manager->persist($photo);
    // }

    // public function createUsers($type, $prestataire, $manager) {

    //     $utilisateur = new Users();
    //     $utilisateur->setEmail($this->faker->email);
    //     $utilisateur->setPassword(
    //         $this->passwordEncoder->hashPassword($utilisateur, 'azertyui') 
    //     );
    //     $utilisateur->setRoles(['ROLE_USER', 'ROLE_PROVIDER']);
    //     $utilisateur->setUserType($type);
    //     $utilisateur->setFailedAttempts(0);
    //     $utilisateur->setBanned(false);
    //     $utilisateur->setProviders($prestataire);

    //     $manager->persist($utilisateur);
    // }
}
