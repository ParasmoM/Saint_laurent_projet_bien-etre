<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Faker\Factory;
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
        $user = new Users();
        $user->setEmail($this->faker->email);
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'azertyui') 
        );
        $user->setRoles(['ROLE_USER', 'ROLE_PROVIDER']);
        $user->setUserType('Provider');
        $user->setFailedAttempts(0);
        $user->setBanned(false);

        $manager->persist($user);
        $manager->flush();
    }
}
