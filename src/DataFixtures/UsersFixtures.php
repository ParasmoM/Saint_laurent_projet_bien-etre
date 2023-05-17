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
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private $faker;
    private $tabFemmes = [
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
    private $tabHommes = [
        'Homme_Africain_01.avif',
        'Homme_Africain_02.avif',
        'Homme_Africain_03.avif',
        'Homme_Africain_04.avif',
        'Homme_Africain_05.avif',
        'Homme_Africain_06.avif',
        'Homme_Africain_07.avif',
        'Homme_Africain_08.avif',
        'Homme_Africain_09.avif',
        'Homme_Africain_10.avif',
        'Homme_Asiatique_01.avif',
        'Homme_Asiatique_02.avif',
        'Homme_Asiatique_03.avif',
        'Homme_Asiatique_04.avif',
        'Homme_Asiatique_05.avif',
        'Homme_Asiatique_06.avif',
        'Homme_Asiatique_07.avif',
        'Homme_Asiatique_08.avif',
        'Homme_Asiatique_09.avif',
        'Homme_Asiatique_10.avif',
        'Homme_Caucasien_01.avif',
        'Homme_Caucasien_02.avif',
        'Homme_Caucasien_03.avif',
        'Homme_Caucasien_04.avif',
        'Homme_Caucasien_05.avif',
        'Homme_Caucasien_06.avif',
        'Homme_Caucasien_07.avif',
        'Homme_Caucasien_08.avif',
        'Homme_Caucasien_09.avif',
        'Homme_Caucasien_10.avif',
        'Homme_Metisse_01.avif',
        'Homme_Metisse_02.avif',
        'Homme_Metisse_03.avif',
        'Homme_Metisse_04.avif',
        'Homme_Metisse_05.avif',
        'Homme_Metisse_06.avif',
        'Homme_Metisse_07.avif',
        'Homme_Metisse_08.avif',
        'Homme_Metisse_09.avif',
        'Homme_Metisse_10.avif',
    ];
    private $adresse = [
        [        
            "Code" => 4540,        
            "Localite" => "Amay",                   
            "Commune" => "Amay"    
        ],
        [        
            "Code" => 4540,        
            "Localite" => "Amay Flône",             
            "Commune" => "Amay"    
        ],
        [        
            "Code" => 4540,        
            "Localite" => "Ampsin",                 
            "Commune" => "Amay"    
        ],
        [        
            "Code" => 4540,        
            "Localite" => "Jehay",                  
            "Commune" => "Amay"    
        ],
        [        
            "Code" => 4540,        
            "Localite" => "Ombret",                 
            "Commune" => "Amay"    
        ],
        [
            "Code" => 4770,
            "Localite" => "Amel",
            "Commune" => "Amel"
        ],
        [
            "Code" => 4770,
            "Localite" => "Meyrode",
            "Commune" => "Amel"
        ],
        [
            "Code" => 4770,
            "Localite" => "Amel",
            "Commune" => "Amel"
        ],
        [
            "Code" => 4770,
            "Localite" => "Meyrode",
            "Commune" => "Amel"
        ],
        [
            "Code" => 4770,
            "Localite" => "Amel",
            "Commune" => "Amel"
        ], // * 10
        [        
            "Code" => 4430,        
            "Localite" => "Ans",                    
            "Commune" => "Ans"    
        ],
        [        
            "Code" => 4431,        
            "Localite" => "Loncin",                 
            "Commune" => "Ans"    
        ],
        [        
            "Code" => 4432,        
            "Localite" => "Alleur",                 
            "Commune" => "Ans"    
        ],
        [        
            "Code" => 4432,        
            "Localite" => "Xhendremael",           
            "Commune" => "Ans"    
        ],
        [        
            "Code" => 4430,        
            "Localite" => "Ans",                    
            "Commune" => "Ans"    
        ],
        [
            "Code" => 4160,
            "Localite" => "Anthisnes",
            "Commune" => "Anthisnes"
        ],
        [
            "Code" => 4161,
            "Localite" => "Villers-Aux-Tours",
            "Commune" => "Anthisnes"
        ],
        [
            "Code" => 4162,
            "Localite" => "Hody",
            "Commune" => "Anthisnes"
        ],
        [
            "Code" => 4163,
            "Localite" => "Tavier",
            "Commune" => "Anthisnes"
        ],
        [
            "Code" => 4160,
            "Localite" => "Anthisnes",
            "Commune" => "Anthisnes"
        ],// * 20
        [
            "Code" => 4880,
            "Localite" => "Aubel",
            "Commune" => "Aubel"
        ],
        [
            "Code" => 4880,
            "Localite" => "Aubel",
            "Commune" => "Aubel"
        ],
        [
            "Code" => 4880,
            "Localite" => "Aubel",
            "Commune" => "Aubel"
        ],
        [
            "Code" => 4880,
            "Localite" => "Aubel",
            "Commune" => "Aubel"
        ],
        [
            "Code" => 4880,
            "Localite" => "Aubel",
            "Commune" => "Aubel"
        ],
        [
            "Code" => 4340,
            "Localite" => "Awans",
            "Commune" => "Awans"
        ],
        [
            "Code" => 4340,
            "Localite" => "Fooz",
            "Commune" => "Awans"
        ],
        [
            "Code" => 4340,
            "Localite" => "Othée",
            "Commune" => "Awans"
        ],
        [
            "Code" => 4340,
            "Localite" => "Villersl'Evêque",
            "Commune" => "Awans"
        ],
        [        
            "Code" => 4342,        
            "Localite" => "Hognoul",                
            "Commune" => "Awans"    
        ],// * 30
        [
            "Code" => 4920,
            "Localite" => "Aywaille",
            "Commune" => "Aywaille"
        ],
        [
            "Code" => 4920,
            "Localite" => "Ernonheid",
            "Commune" => "Aywaille"
        ],
        [
            "Code" => 4920,
            "Localite" => "Harzé",
            "Commune" => "Aywaille"
        ],
        [
            "Code" => 4920,
            "Localite" => "Louveigné",
            "Commune" => "Aywaille"
        ],
        [
            "Code" => 4920,
            "Localite" => "Sougné-Remouchamps",
            "Commune" => "Aywaille"
        ],
        [
            "Code" => 4837,
            "Localite" => "Baelen",
            "Commune" => "Baelen"
        ],
        [
            "Code" => 4837,
            "Localite" => "Membach",
            "Commune" => "Baelen"
        ],
        [
            "Code" => 4837,
            "Localite" => "Baelen",
            "Commune" => "Baelen"
        ],
        [
            "Code" => 4837,
            "Localite" => "Membach",
            "Commune" => "Baelen"
        ],
        [
            "Code" => 4837,
            "Localite" => "Baelen",
            "Commune" => "Baelen"
        ],// * 40
        [
            "Code" => 4690,
            "Localite" => "Bassenge",
            "Commune" => "Bassenge"
        ],
        [
            "Code" => 4690,
            "Localite" => "Boirs",
            "Commune" => "Bassenge"
        ],
        [
            "Code" => 4690,
            "Localite" => "Eben-Emael",
            "Commune" => "Bassenge"
        ],
        [
            "Code" => 4690,
            "Localite" => "Glons",
            "Commune" => "Bassenge"
        ],
        [
            "Code" => 4690,
            "Localite" => "Roclenge-Sur-Geer",
            "Commune" => "Bassenge"
        ],
        [
            "Code" => 4257,
            "Localite" => "Berloz",
            "Commune" => "Berloz"
        ],
        [
            "Code" => 4257,
            "Localite" => "Corswarem",
            "Commune" => "Berloz"
        ],
        [
            "Code" => 4257,
            "Localite" => "Rosoux-Crenwick",
            "Commune" => "Berloz"
        ],
        [
            "Code" => 4257,
            "Localite" => "Berloz",
            "Commune" => "Berloz"
        ],
        [
            "Code" => 4257,
            "Localite" => "Corswarem",
            "Commune" => "Berloz"
        ],// * 50
        [        
            "Code" => 4610,        
            "Localite" => "Bellaire",               
            "Commune" => "Beyne-Heusay"    
        ],
        [        
            "Code" => 4610,        
            "Localite" => "Beyne-Heusay",           
            "Commune" => "Beyne-Heusay"    
        ],
        [        
            "Code" => 4610,        
            "Localite" => "Queue-Du-Bois",          
            "Commune" => "Beyne-Heusay"    
        ],
        [        
            "Code" => 4610,        
            "Localite" => "Bellaire",               
            "Commune" => "Beyne-Heusay"    
        ],
        [        
            "Code" => 4610,        
            "Localite" => "Beyne-Heusay",           
            "Commune" => "Beyne-Heusay"    
        ],
        [        
            "Code" => 4670,        
            "Localite" => "Blégny",                 
            "Commune" => "Blegny"    
        ],
        [        
            "Code" => 4670,        
            "Localite" => "Mortier",                
            "Commune" => "Blegny"    
        ],
        [        
            "Code" => 4670,        
            "Localite" => "Trembleur",              
            "Commune" => "Blegny"    
        ],
        [        
            "Code" => 4671,        
            "Localite" => "Barchon",                
            "Commune" => "Blegny"    
        ],
        [        
            "Code" => 4671,        
            "Localite" => "Housse",                 
            "Commune" => "Blegny"    
        ],// * 6
        [
            "Code" => 4260,
            "Localite" => "Braives",
            "Commune" => "Braives"
        ],
        [
            "Code" => 4260,
            "Localite" => "Ciplet",
            "Commune" => "Braives"
        ],
        [
            "Code" => 4260,
            "Localite" => "Fallais",
            "Commune" => "Braives"
        ],
        [
            "Code" => 4260,
            "Localite" => "Fumal",
            "Commune" => "Braives"
        ],
        [
            "Code" => 4260,
            "Localite" => "Vennes",
            "Commune" => "Braives"
        ],
        [
            "Code" => 4760,
            "Localite" => "Büllingen",
            "Commune" => "Bullange"
        ],
        [
            "Code" => 4760,
            "Localite" => "Manderfeld",
            "Commune" => "Bullange"
        ],
        [
            "Code" => 4761,
            "Localite" => "Rocherath",
            "Commune" => "Bullange"
        ],
        [
            "Code" => 4760,
            "Localite" => "Büllingen",
            "Commune" => "Bullange"
        ],
        [
            "Code" => 4760,
            "Localite" => "Manderfeld",
            "Commune" => "Bullange"
        ],// * 7
        [
            "Code" => 4210,
            "Localite" => "Burdinne",
            "Commune" => "Burdinne"
        ],
        [
            "Code" => 4210,
            "Localite" => "Hannêche",
            "Commune" => "Burdinne"
        ],
        [
            "Code" => 4210,
            "Localite" => "Lamontzée",
            "Commune" => "Burdinne"
        ],
        [
            "Code" => 4210,
            "Localite" => "Marneffe",
            "Commune" => "Burdinne"
        ],
        [
            "Code" => 4210,
            "Localite" => "Oteppe",
            "Commune" => "Burdinne"
        ],
        [
            "Code" => 4790,
            "Localite" => "Burg-Reuland",
            "Commune" => "Burg-Reuland"
        ],
        [
            "Code" => 4790,
            "Localite" => "Reuland",
            "Commune" => "Burg-Reuland"
        ],
        [
            "Code" => 4791,
            "Localite" => "Thommen",
            "Commune" => "Burg-Reuland"
        ],
        [
            "Code" => 4790,
            "Localite" => "Burg-Reuland",
            "Commune" => "Burg-Reuland"
        ],
        [
            "Code" => 4790,
            "Localite" => "Reuland",
            "Commune" => "Burg-Reuland"
        ],// * 8
    ];

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
        $this->createProvider(40, $manager);
    }

    public function createProvider($nbr, $manager) {
        $faker = Factory::create('fr_BE');

        for($user = 1; $user <= $nbr; $user++) {
            // Nouveau Prestataire
            $prestataire = new Providers();
            $prestataire->setLastName($faker->lastName);
            $prestataire->setFirstName($faker->firstNameFemale());
            $prestataire->setDescription($faker->sentences(10, true));
            $prestataire->setPhoneNumber($faker->numerify('04########'));
            $prestataire->setTvaNumber($faker->vat);
            $prestataire->setWebsiteUrl('https://github.com/');
            $prestataire->setFacebook('https://fr-fr.facebook.com/');
            $prestataire->setInstagram('https://www.instagram.com/');
            $prestataire->setTwitter('https://twitter.com/');
            
            $logo = new Images();
            $logo->setName('logo.webp');
            $logo->setProviders($prestataire);
            $manager->persist($logo);
            $prestataire->setProviderLogo($logo);

            // On crée 10 services pour le prestataire
            $this->createPromo($prestataire, $manager);

            // on crée un stage 
            $this->createInternships($prestataire, $manager);

            // on lui crée une galleries d'images
            $this->createImageGallery($prestataire, $manager);

            // On l'associer une image de profil 
            $this->createImageProfile($prestataire, 'femme', $manager);

            // Nouveau Utilisateur 
            $this->createUsers($prestataire, $manager);
            
            $manager->flush();

            $prestataire = new Providers();
            $prestataire->setLastName($faker->lastName);
            $prestataire->setFirstName($faker->firstNameMale());
            $prestataire->setDescription($faker->sentences(10, true));
            $prestataire->setPhoneNumber($faker->numerify('04########'));
            $prestataire->setTvaNumber($faker->vat);
            $prestataire->setWebsiteUrl('https://github.com/');
            $prestataire->setFacebook('https://fr-fr.facebook.com/');
            $prestataire->setInstagram('https://www.instagram.com/');
            $prestataire->setTwitter('https://twitter.com/');
            
            $logo = new Images();
            $logo->setName('logo.webp');
            $logo->setProviders($prestataire);
            $manager->persist($logo);
            $prestataire->setProviderLogo($logo);

            // On crée 10 services pour le prestataire
            $this->createPromo($prestataire, $manager);

            // on crée un stage 
            $this->createInternships($prestataire, $manager);

            // on lui crée une galleries d'images
            $this->createImageGallery($prestataire, $manager);

            // On l'associer une image de profil 
            $this->createImageProfile($prestataire, 'homme', $manager);

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
                $randomNumber = rand(0, 1);

                $promo = new Promotions();
                $promo->setName('Service ' . $promoCounter);
                $promo->setDescription($faker->sentences(10, true));
                $promo->setStartDate($date_actuelle);
                $promo->setEndDate($date_plus_365);
                if ($randomNumber == 0) {
                    $promo->setDisplayFromDate($date_actuelle);
                    $promo->setDisplayUntilDate($date_plus_365);
                } else {
                    $promo->setDisplayFromDate($date_semaine_derniere);
                    $promo->setDisplayUntilDate($date_hier);
                }
                $promo->setService($randomCategories[$index]);
                $promo->setProviders($prestataire);
        
                $manager->persist($promo);
                $promoCounter++;
            }
        }     
        
        /* for ($cpt = 1; $cpt <= 3; $cpt++) {
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
        } */
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
        $stage->setAdditionalInformation($faker->sentences(2, true));
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

    public function createImageGallery($prestataire, $manager ,int $nbr = 10) {
        for ($i = 1; $i <= $nbr; $i++) {
            $image = new Images();

            $randomNumber = rand(1, 150);

            $image->setName($randomNumber . '.avif');
            $image->setOrderNumber($i);
            $image->setProviders($prestataire);
            $manager->persist($image);
        }
    }

    public function createImageProfile($prestataire, $sexe, $manager) {
        if ($sexe == 'femme') {
            $randomKey = array_rand($this->tabFemmes);
            $randomImage = $this->tabFemmes[$randomKey];

            unset($this->tabFemmes[$randomKey]);
        }
        if ($sexe == 'homme') {
            $randomKey = array_rand($this->tabHommes);
            $randomImage = $this->tabHommes[$randomKey];
            
            unset($this->tabHommes[$randomKey]);
        }

        // Créez et enregistrez une nouvelle entité Images
        $photo = new Images();
        $photo->setName($randomImage);
        $photo->setProviderPhoto($prestataire);
        $photo->setProviders($prestataire);
        $manager->persist($photo);

        $prestataire->setProviderPhoto($photo);
    }

    public function createUsers($prestataire, $manager) {
        $randomKey = array_rand($this->adresse);
        $chosenAdresse = $this->adresse[$randomKey];

        unset($this->adresse[$randomKey]);

        $user = new Users();
        $user->setEmail($this->faker->email);
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, '@1Azertyui') 
        );
        $user->setRoles(['ROLE_PROVIDER']);
        $user->setUserType('Providers');
        $user->setFailedAttempts(0);
        $user->setBanned(false);
        $user->setPostalCode($this->postalCodesRepository->findOneBy(['name' => $chosenAdresse['Code']]));
        $user->setLocality($this->localitiesRepository->findOneBy(['name' => $chosenAdresse['Localite']]));
        $user->setTown($this->townsRepository->findOneBy(['name' => $chosenAdresse['Commune']]));
        $user->setProviders($prestataire);
        $user->setAddressStreet('Rue St Laurent');
        $user->setAdressNumber('29');

        $manager->persist($user);
    }
}
