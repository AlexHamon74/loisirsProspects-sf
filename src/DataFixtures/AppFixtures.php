<?php

namespace App\DataFixtures;

use App\Entity\Saison;
use App\Entity\User;
use App\Entity\Equipe;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use App\Enum\Position;

class AppFixtures extends Fixture
{

    const NOM_EQUIPE = ['Valence', 'Lyon', 'Chambery', 'Vaujany', 'Albertville', 'Nîmes', 'Avignon'];
    const PRENOM = [
        'Joe', 'Jane', 'Alex', 'Chris', 'Pat', 'Taylor', 'Jordan', 'Morgan', 'Casey', 'Riley', 
        'Sam', 'Jamie', 'Cameron', 'Drew', 'Quinn', 'Avery', 'Reese', 'Skyler', 'Parker', 'Rowan'
    ];
    const EMAILS = [
        'joe@test.com', 'jane@test.com', 'alex@test.com', 'chris@test.com', 'pat@test.com', 
        'taylor@test.com', 'jordan@test.com', 'morgan@test.com', 'casey@test.com', 'riley@test.com', 
        'sam@test.com', 'jamie@test.com', 'cameron@test.com', 'drew@test.com', 'quinn@test.com', 
        'avery@test.com', 'reese@test.com', 'skyler@test.com', 'parker@test.com', 'rowan@test.com'
    ];

    
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create();

        // Saison
        $saison = new Saison();
        $saison->setAnnee(2024);
        $manager->persist($saison);

        // Equipes
        $equipes = [];
        foreach(self::NOM_EQUIPE as $nom_equipe) {
            $equipe = new Equipe();
            $equipe->setNom($nom_equipe)
                ->setUpdatedAt(new DateTimeImmutable());

            $manager->persist($equipe);
            $equipes[] = $equipe;
        }

        // Utilisateur Admin
        $admin_user = new User();
        $admin_user->setEmail('admin@test.com')
            ->setFirstname('Admin')
            ->setName('Test')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($admin_user, 'admin123'))
            ->setUpdatedAt(new DateTimeImmutable());

        $manager->persist($admin_user);

        // Joueurs
        $positions = Position::cases();
        for($i=0; $i<20; $i++) {
            $joueur = new User();
            $joueur->setEmail(self::EMAILS[$i % count(self::EMAILS)])
                ->setFirstname(self::PRENOM[$i % count(self::PRENOM)])
                ->setName('Test')
                ->setPassword($this->hasher->hashPassword($joueur, 'test123'))
                ->setBirthdate(new DateTimeImmutable())
                ->setHeight($generator->numberBetween(160, 200))
                ->setWeight($generator->numberBetween(60, 100))
                ->setJerseyNumber($generator->numberBetween(1, 99))
                ->setPosition($positions[$i % count($positions)])
                ->setEquipe($generator->randomElement($equipes))
                ->setUpdatedAt(new DateTimeImmutable());

            $manager->persist($joueur);
        }

        // Envoi des modification en base
        $manager->flush();
    }
}
