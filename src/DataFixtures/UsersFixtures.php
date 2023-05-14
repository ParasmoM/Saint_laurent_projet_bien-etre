<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Users;
use App\Entity\Images;
use App\Utils\Adresse;
use App\Entity\Providers;
use App\Entity\Promotions;
use App\Entity\CategoriesOfServices;
use App\Entity\Internships;
use App\Repository\LocalitiesRepository;
use App\Repository\PostalCodesRepository;
use App\Repository\TownsRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private $faker;

    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder, 
        private PostalCodesRepository $postalCodesRepository,
        private LocalitiesRepository $localitiesRepository,
        private TownsRepository $townsRepository
    ) {
        $this->faker = $faker = Factory::create('fr_BE');
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->createProvider(40, 'femme', $manager);
    }

    public function createProvider($nbr, $sexe, $manager) {
        $faker = Factory::create('fr_BE');

        for($user = 1; $user <= $nbr; $user++) {
            // Nouveau Prestataire
            $prestataire = new Providers();
            $prestataire->setLastName($faker->lastName);
            $prestataire->setFirstName($faker->firstName($sexe));
            $prestataire->setDescription($faker->vat);
            $prestataire->setPhoneNumber($faker->numerify('04########'));
            $prestataire->setTvaNumber($faker->sentences(10, true));
            $prestataire->setWebsiteUrl('https://github.com/');
            $prestataire->setFacebook('https://fr-fr.facebook.com/');
            $prestataire->setInstagram('https://www.instagram.com/');
            $prestataire->setTwitter('https://twitter.com/');
            
            $logo = new Images();
            $logo->setName('logo.webp');
            $manager->persist($logo);
            $prestataire->setProviderLogo($logo);

            // On crée 10 services pour le prestataire
            $this->createPromo($prestataire, $manager);

            // on crée un stage 
            $this->createInternships($prestataire, $manager);

            // On l'associer une image de profil 
            $this->createImageProfile($prestataire, $sexe, $manager);

            // Nouveau Utilisateur 
            $this->createUsers($prestataire, $manager);
            
            $manager->flush();
        }
    }

    public function createPromo($prestataire, $manager) {
        $faker = Factory::create('fr_BE');
        $date_actuelle = new DateTime();
        $date_plus_365 = new DateTime('+365 days');
        $date_semaine_derniere = new DateTime('-7 days');
        $date_hier = new DateTime('-1 days');

        $categoriesRepository = $manager->getRepository(CategoriesOfServices::class);
        $categories = $categoriesRepository->findAll();

        // Obtenez 3 clés aléatoires
        $randomKeys = array_rand($categories, 2);

        // Récupérez les catégories correspondantes
        $randomCategories = [];
        foreach ($randomKeys as $key) {
            $randomCategories[] = $categories[$key];
        }

        $promotionsCount = [7, 3]; // Nombre de fois pour chaque catégorie aléatoire
        $promoCounter = 1;

        foreach ($promotionsCount as $index => $count) {
            for ($cpt = 1; $cpt <= $count; $cpt++) {
                $promo = new Promotions();
                $promo->setName('Service ' . $promoCounter);
                $promo->setDescription($faker->sentences(10, true));
                $promo->setStartDate($date_actuelle);
                $promo->setEndDate($date_plus_365);
                $promo->setDisplayFromDate($date_actuelle);
                $promo->setDisplayUntilDate($date_plus_365);
                $promo->setService($randomCategories[$index]);
                $promo->setProviders($prestataire);
        
                $manager->persist($promo);
                $promoCounter++;
            }
        }     
        
        for ($cpt = 1; $cpt <= 3; $cpt++) {
            $promo = new Promotions();
            $promo->setName('Service ' . $promoCounter);
            $promo->setDescription($faker->sentences(10, true));
            $promo->setStartDate($date_actuelle);
            $promo->setEndDate($date_plus_365);
            $promo->setDisplayFromDate($date_semaine_derniere);
            $promo->setDisplayUntilDate($date_hier);
            $promo->setService($randomCategories[$index]);
            $promo->setProviders($prestataire);
    
            $manager->persist($promo);
            $promoCounter++;
        }
    }
    
    public function createInternships($prestataire, $manager) {
        $faker = Factory::create('fr_BE');
        $date_actuelle = new DateTime();
        $date_plus_365 = new DateTime('+365 days');
        $date_semaine_derniere = new DateTime('-7 days');
        $date_hier = new DateTime('-1 days');

        $stage = new Internships();
        $stage->setName('STAGE 1');
        $stage->setDescription($faker->sentences(10, true));
        $stage->setAdditionalInformation($faker->sentences(4, true));
        $stage->setStartDate($date_actuelle);
        $stage->setEndDate($date_plus_365);
        $stage->setDisplayFromDate($date_actuelle);
        $stage->setDisplayUntilDate($date_plus_365);
        $tarif = $faker->randomFloat(2, 20, 150);
        $stage->setRate($tarif);
        $stage->setProviders($prestataire);

        $manager->persist($stage);

        for ($cpt = 1; $cpt <= 3; $cpt++) {
            $stage = new Internships();
            $stage->setName('STAGE ' . $cpt);
            $stage->setDescription($faker->sentences(10, true));
            $stage->setAdditionalInformation($faker->sentences(4, true));
            $stage->setStartDate($date_actuelle);
            $stage->setEndDate($date_plus_365);
            $stage->setDisplayFromDate($date_semaine_derniere);
            $stage->setDisplayUntilDate($date_hier);
            $tarif = $faker->randomFloat(2, 20, 150);
            $stage->setRate($tarif);
            $stage->setProviders($prestataire);
    
            $manager->persist($stage);
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

        $prestataire->setProviderPhoto($photo);
    }

    public function createUsers($prestataire, $manager) {
        $tabAdresse = Adresse::getAdresse();
        $randomKeys = array_rand($tabAdresse, 1);
        $randomAdresse = $tabAdresse[$randomKeys];

        $user = new Users();
        $user->setEmail($this->faker->email);
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, '@1Azertyui') 
        );
        $user->setRoles(['ROLE_PROVIDER']);
        $user->setUserType('Providers');
        $user->setFailedAttempts(0);
        $user->setBanned(false);
        $user->setPostalCode($this->postalCodesRepository->findOneBy(['name' => $randomAdresse['Code']]));
        $user->setLocality($this->localitiesRepository->findOneBy(['name' => $randomAdresse['Localite']]));
        $user->setTown($this->townsRepository->findOneBy(['name' => $randomAdresse['Commune']]));
        $user->setProviders($prestataire);
        $user->setAddressStreet('Rue St Laurent');
        $user->setAdressNumber('29');

        $manager->persist($user);
    }
}
