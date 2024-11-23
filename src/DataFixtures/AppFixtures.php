<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('bob@test.com')
            ->setFirstname('Bob')
            ->setName('Test')
            ->setPassword($this->hasher->hashPassword($user, 'bob123'))
            ->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($user);   

        $manager->flush();
    }
}
