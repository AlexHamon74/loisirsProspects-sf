<?php

namespace App\DataFixtures;

use App\Entity\Assistance;
use App\Entity\But;
use App\Entity\Saison;
use App\Entity\User;
use App\Entity\Equipe;
use App\Entity\Rencontre;
use App\Entity\Participation;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use App\Enum\Position;
use App\Enum\TypeRencontre;
use Doctrine\ORM\EntityManagerInterface;

class AppFixtures extends Fixture
{
    const NOM_EQUIPE = ['Valence', 'Lyon', 'Annecy', 'Vaujany', 'Montpellier', 'Clermont-ferrand', 'Hogly', 'Roanne', 'Toulouse', 'Anglet 2', 'Francais volants'];

    const JOUEURS_VALENCE = [
        [
            ['ROLE_RESPONSABLE'], 'jan@dlouhy.fr', 'test123', 'Dlouhy', 'Jan', '1975-09-27', 185, 87, 2, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'enzo@dousseau.fr', 'test123', 'Dousseau', 'Enzo', '2000-02-05', 181, 65, 10, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'dmitrii@dudkin.fr', 'test123', 'Dudkin', 'Dmitrii', '2001-08-23', NULL, NULL, 71, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'aleksei@baskov.fr', 'test123', 'Baskov', 'Aleksei', '1994-01-22', NULL, NULL, 19, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'rudi@maarni.fr', 'test123', 'Maarni', 'Rudi', '2001-04-19', NULL, NULL, 29, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'jules@plenet.fr', 'test123', 'Plenet', 'Jules', '2004-04-16', NULL, NULL, 06, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'sam@riffard.fr', 'test123', 'Riffard', 'Sam', '2004-09-27', NULL, NULL, 04, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'maxence@bortino.fr', 'test123', 'Bortino', 'Maxence', '2001-08-20', 168, 63, 11, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'arnaud@lazzaroni.fr', 'test123', 'Lazzaroni', 'Arnaud', '1992-05-19', 188, 74, 26, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'otto@pitkanen.fr', 'test123', 'Pitkänen', 'Otto', '2003-01-18', 178, 77, 28, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'antoine@goutefangea.fr', 'test123', 'Goutefangea', 'Antoine', '2004-12-15', 176, 63, 27, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'enzo@lebouche.fr', 'test123', 'Lebouché', 'Enzo', '2004-11-13', 186, 84, 61, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'kevin@richard.fr', 'test123', 'Richard', 'Kevin', '1997-03-13', 184, 84, 97, NULL, 'now', 'Défenseur'
        ],
    ];

    const JOUEUR_RENCONTRE_VALENCE = [
        '2024-10-05' => ['Richard', 'Lebouché', 'Goutefangea', 'Pitkänen', 'Lazzaroni'],
        '2024-10-12' => ['Richard', 'Lebouché', 'Goutefangea'],
    ];

    const BUTEUR_RENCONTRE_VALENCE = [
        '2024-10-05' => ['Maarni', 'Lebouché'],
        '2024-10-12' => ['Pitkänen', 'Lazzaroni'],
    ];

    const ASSISTANCE_RENCONTRE_VALENCE = [
        '2024-10-05' => [
            'Maarni' => ['Richard', 'Pitkänen'], 
            'Lebouché' => ['Goutefangea', 'Lazzaroni'],
        ],
        '2024-10-12' => [
            'Pitkänen' => ['Lazzaroni'],
            'Lazzaroni' => ['Maarni'],
        ],
    ];


    const RENCONTRES_VALENCE = [
        [
            'Valence', 'Annecy', '2024-10-05', 6, 1, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Lyon', 'Valence', '2024-10-12', 1, 0, 'Championnat', NULL, 'now', 'Lyon - Charlemagne', '19:30:00'
        ],
        [
            'Valence', 'Montpellier', '2024-10-19', 2, 7, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Vaujany', 'Valence', '2024-10-26', 6, 3, 'Championnat', NULL, 'now', 'Vaujany - Patinoire', '19:00:00'
        ],
        [
            'Clermont-ferrand', 'Valence', '2024-11-02', 4, 3, 'Championnat', NULL, 'now', 'Clermont-Ferrand', '20:30:00'
        ],
        [
            'Anglet 2', 'Valence', '2024-11-09', 3, 6, 'Championnat', NULL, 'now', 'Anglet - La Barre', '18:30:00'
        ],
        [
            'Valence', 'Hogly', '2024-11-16', 3, 4, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '18:30:00'
        ],
        [
            'Roanne', 'Valence', '2024-11-23', 3, 5, 'Championnat', NULL, 'now', 'Roanne - Fontalon', '19:30:00'
        ],
        [
            'Valence', 'Toulouse', '2024-11-30', 8, 3, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Valence', 'Lyon', '2024-12-07', 1, 4, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Montpellier', 'Valence', '2024-12-14', 5, 4, 'Championnat', NULL, 'now', 'Montpellier - Vegapolis', '19:00:00'
        ],
        [
            'Valence', 'Vaujany', '2024-12-21', 4, 6, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Valence', 'Clermont-ferrand', '2025-01-11', 9, 2, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Valence', 'Anglet 2', '2025-01-18', 4, 3, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Hogly', 'Valence', '2025-01-25', 3, 7, 'Championnat', NULL, 'now', 'La-Roche-sur-Yon - Arago', '18:30:00'
        ],
        [
            'Toulouse', 'Valence', '2025-02-08', 3, 5, 'Championnat', NULL, 'now', 'Blagnac Toulouse - Jacques Raynaud', '19:30:00'
        ],
        [
            'Valence', 'Roanne', '2025-02-12', 8, 5, 'Championnat', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
        [
            'Annecy', 'Valence', '2025-02-22', 7, 3, 'Championnat', NULL, 'now', 'Annecy - Jean Régis', '20:30:00'
        ],
        [
            'Francais volants', 'Valence', '2025-03-01', 4, 6, 'Playoffs', NULL, 'now', 'Paris Bercy - Sonja Henie', '18:40:00'
        ],
        [
            'Valence', 'Francais volants', '2025-03-08', 7, 0, 'Playoffs', NULL, 'now', 'Valence - Le Polygone', '20:30:00'
        ],
    ];

    public function __construct(private UserPasswordHasherInterface $hasher, private EntityManagerInterface $entityManager) {}

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
                ->setUpdatedAt(new DateTimeImmutable())
                ->setInformationGenerale($generator->realTextBetween());

            $manager->persist($equipe);
            $equipes[$nom_equipe] = $equipe;
        }

        // Envoi des modification en base pour avoir accès aux ID des équipes
        // ------------------------------------------------------------------
        $manager->flush();

        // Ajout de l'admin
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN'])
            ->setEmail('admin@test.com')
            ->setPassword('admin123')
            ->setName('admin')
            ->setFirstname('admin')
            ->setUpdatedAt(new DateTimeImmutable());

        $manager->persist($admin);


        // Joueurs de Valence
        $joueurs = [];
        foreach(self::JOUEURS_VALENCE as $joueurData) {
            $joueur = new User();
            $joueur->setRoles($joueurData[0])
                ->setEmail($joueurData[1])
                ->setPassword($this->hasher->hashPassword($joueur, $joueurData[2]))
                ->setName($joueurData[3])
                ->setFirstname($joueurData[4])
                ->setBirthdate(new \DateTimeImmutable($joueurData[5]))
                ->setHeight($joueurData[6])
                ->setWeight($joueurData[7])
                ->setJerseyNumber($joueurData[8])
                ->setProfilPicture($joueurData[9])
                ->setUpdatedAt(new \DateTimeImmutable($joueurData[10]))
                ->setPosition(Position::from($joueurData[11]))
                ->setEquipe($equipes['Valence']);
        
            $manager->persist($joueur);
            $joueurs[$joueurData[3]] = $joueur;
        }

        // Rencontres de Valence
        $rencontres = [];
        foreach(self::RENCONTRES_VALENCE as $rencontreData) {
            $rencontre = new Rencontre();
            $rencontre->setSaison($saison)
                ->setEquipeDomicile($equipes[$rencontreData[0]])
                ->setEquipeExterieur($equipes[$rencontreData[1]])
                ->setDate(new \DateTimeImmutable($rencontreData[2]))
                ->setScoreEquipeDomicile($rencontreData[3])
                ->setScoreEquipeExterieur($rencontreData[4])
                ->setTypeRencontre(TypeRencontre::from($rencontreData[5]))
                ->setAffiche($rencontreData[6])
                ->setUpdatedAt(new \DateTimeImmutable($rencontreData[7]))
                ->setLieu($rencontreData[8])
                ->setHeure(new \DateTimeImmutable($rencontreData[9]));

            $manager->persist($rencontre);
            $rencontres[$rencontreData[2]] = $rencontre;
        } 

        // Envoi des modification en base pour avoir accès aux ID des joueurs et rencontres
        // --------------------------------------------------------------------------------
        $manager->flush();

        // Ajout des participations par rencontre
        foreach (self::JOUEUR_RENCONTRE_VALENCE as $date => $joueursData) {
            foreach ($joueursData as $joueurNom) {
                $participation = new Participation();
                $participation->setRencontre($rencontres[$date])
                    ->setUser($joueurs[$joueurNom]);

                $manager->persist($participation);
            }
        }

        // Ajout des buteurs et des assistances par rencontre
        foreach (self::BUTEUR_RENCONTRE_VALENCE as $date => $buteursData) {
            $buts = [];
            foreach ($buteursData as $buteurNom) {
                $but = new But();
                $but->setRencontre($rencontres[$date])
                    ->setUser($joueurs[$buteurNom]);

                $manager->persist($but);
                $buts[] = $but;

                // Vérifier s'il y a des assistances pour ce but
                if (isset(self::ASSISTANCE_RENCONTRE_VALENCE[$date][$buteurNom])) {
                    foreach (self::ASSISTANCE_RENCONTRE_VALENCE[$date][$buteurNom] as $assistantNom) {
                        $assistance = new Assistance();
                        $assistance->setBut($but)
                            ->setUser($joueurs[$assistantNom]);

                        $manager->persist($assistance);
                    }
                }
            }
        }

        // Envoi finale des modification en base
        $manager->flush();
    }
}
