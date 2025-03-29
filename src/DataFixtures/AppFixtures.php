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
        // Coach
        [
            ['ROLE_RESPONSABLE'], 'jan@dlouhy.fr', 'test123', 'Dlouhy', 'Jan', '1975-09-27', 185, 87, 2, NULL, 'now', 'Défenseur'
        ],

        // Gardiens
        [
            ['ROLE_USER'], 'nans@blanc.fr', 'test123', 'Blanc', 'Nans', '2001-08-10', 171, 68, 25, NULL, 'now', 'Gardien'
        ],
        [
            ['ROLE_USER'], 'theo@gautero.fr', 'test123', 'Gautero', 'Théo', '1998-03-04', 174, 74, 51, NULL, 'now', 'Gardien'
        ],

        // Défenseurs
        [
            ['ROLE_USER'], 'enzo@dousseau.fr', 'test123', 'Dousseau', 'Enzo', '2000-02-05', 181, 65, 10, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'sofian@lahssini.fr', 'test123', 'Lahssini', 'Sofian', '2007-08-11', NULL, NULL, NULL, NULL, 'now', 'Gardien'
        ],
        [
            ['ROLE_USER'], 'arnaud@lazzaroni.fr', 'test123', 'Lazzaroni', 'Arnaud', '1992-05-19', 188, 74, 26, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'kevin@richard.fr', 'test123', 'Richard', 'Kevin', '1997-03-13', 184, 84, 97, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'sam@riffard.fr', 'test123', 'Riffard', 'Sam', '2004-09-27', 174, 75, 4, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'alban@rodriguez.fr', 'test123', 'Rodriguez.A', 'Alban', '1998-01-24', 182, 78, 66, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'quentin@rodriguez.fr', 'test123', 'Rodriguez.Q', 'Quentin', '1993-05-04', 189, 85, 8, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'zinger@sahran.fr', 'test123', 'Zinger', 'Sahran', '2003-07-24', 175, 74, 17, NULL, 'now', 'Défenseur'
        ],
        [
            ['ROLE_USER'], 'artyom@tkachenko.fr', 'test123', 'Tkachenko', 'Artyom', '2000-03-10', 192, 92, 7, NULL, 'now', 'Défenseur'
        ],

        // Attaquants
        [
            ['ROLE_USER'], 'franck@amouriq.fr', 'test123', 'Amouriq', 'Franck', '2003-10-15', 173, 68, 79, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'aleksei@baskov.fr', 'test123', 'Baskov', 'Aleksei', '1994-01-22', 193, 93, 19, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'maxence@bortino.fr', 'test123', 'Bortino', 'Maxence', '2001-08-20', 168, 63, 11, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'mateo@briancon.fr', 'test123', 'Briancon', 'Matéo', '2003-08-27', 183, 80, 93, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'valentin@clement.fr', 'test123', 'Clement', 'Valentin', '1995-09-25', 171, 71, 9, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'dmitrii@dudkin.fr', 'test123', 'Dudkin', 'Dmitrii', '2001-08-23', 177, 83, 71, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'enzo@favarin.fr', 'test123', 'Favarin', 'Enzo', '2003-06-10', 183, 76, 14, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'antoine@goutefangea.fr', 'test123', 'Goutefangea', 'Antoine', '2004-12-15', 176, 63, 27, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'nikita@klyuev.fr', 'test123', 'Klyuev', 'Nikita', '2002-03-11', 175, 65, 87, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'joris@lavorel.fr', 'test123', 'Lavorel', 'Joris', '2005-01-16', 183, 66, NULL, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'enzo@lebouche.fr', 'test123', 'Lebouché', 'Enzo', '2004-11-13', 186, 84, 61, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'rudi@maarni.fr', 'test123', 'Maarni', 'Rudi', '2001-04-19', 181, 85, 29, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'alexis@pelisse.fr', 'test123', 'Pelisse', 'Alexis', '1988-01-26', 179, 70, 77, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'otto@pitkanen.fr', 'test123', 'Pitkänen', 'Otto', '2003-01-18', 178, 77, 28, NULL, 'now', 'Attaquant'
        ],
        [
            ['ROLE_USER'], 'jules@plenet.fr', 'test123', 'Plenet', 'Jules', '2004-04-16', NULL, NULL, 6, NULL, 'now', 'Attaquant'
        ],
    ];

    const JOUEUR_RENCONTRE_VALENCE = [
        '2024-10-05' => ['Riffard', 'Plenet', 'Zinger', 'Rodriguez.A', 'Clement', 'Dousseau', 'Pitkänen', 'Lazzaroni', 'Goutefangea', 'Maarni', 'Lebouché', 'Klyuev', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Richard'],
        '2024-10-12' => ['Riffard', 'Plenet', 'Goutefangea', 'Rodriguez.A', 'Clement', 'Zinger', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-10-19' => ['Riffard', 'Plenet', 'Goutefangea', 'Rodriguez.A', 'Clement', 'Zinger', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-10-26' => ['Riffard', 'Plenet', 'Goutefangea', 'Rodriguez.A', 'Clement', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.Q', 'Dudkin', 'Lavorel', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-11-02' => ['Riffard', 'Plenet', 'Goutefangea', 'Rodriguez.A', 'Clement', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-11-09' => ['Riffard', 'Plenet', 'Goutefangea', 'Rodriguez.A', 'Clement', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Lavorel', 'Rodriguez.Q', 'Dudkin', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-11-16' => ['Riffard', 'Plenet', 'Rodriguez.A', 'Clement', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Lavorel', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-11-23' => ['Riffard', 'Plenet', 'Rodriguez.A', 'Clement', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-11-30' => ['Riffard', 'Plenet', 'Rodriguez.A', 'Clement', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-12-07' => ['Riffard', 'Plenet', 'Rodriguez.A', 'Clement', 'Zinger', 'Pitkänen', 'Maarni', 'Favarin', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-12-14' => ['Riffard', 'Plenet', 'Rodriguez.A', 'Clement', 'Bortino', 'Zinger', 'Pitkänen', 'Maarni', 'Lahssini', 'Rodriguez.Q', 'Dudkin', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2024-12-21' => ['Riffard', 'Rodriguez.A', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Lahssini', 'Rodriguez.Q', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-01-11' => ['Riffard', 'Plenet', 'Tkachenko', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Lahssini', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-01-18' => ['Riffard', 'Plenet', 'Tkachenko', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Lahssini', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-01-25' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-02-08' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-02-12' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-02-22' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-03-01' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
        '2025-03-08' => ['Riffard', 'Plenet', 'Tkachenko', 'Rodriguez.Q', 'Clement', 'Bortino', 'Zinger', 'Baskov', 'Lazzaroni', 'Pitkänen', 'Maarni', 'Rodriguez.A', 'Dudkin', 'Pelisse', 'Amouriq', 'Klyuev', 'Dousseau', 'Briancon', 'Richard'],
    ];

    const BUTEUR_RENCONTRE_VALENCE = [
        '2024-10-05' => ['Maarni', 'Lazzaroni', 'Dousseau', 'Richard', 'Plenet', 'Pitkänen'],
        '2024-10-12' => [],
        '2024-10-19' => ['Maarni', 'Pitkänen'],
        '2024-10-26' => ['Pelisse', 'Lavorel', 'Plenet'],
        '2024-11-02' => ['Dudkin', 'Klyuev', 'Dudkin'],
        '2024-11-09' => ['Baskov', 'Richard', 'Plenet', 'Pitkänen', 'Dudkin', 'Baskov'],
        '2024-11-16' => ['Lazzaroni', 'Pelisse', 'Dudkin'],
        '2024-11-23' => ['Dudkin', 'Maarni', 'Dudkin', 'Pitkänen', 'Klyuev'],
        '2024-11-30' => ['Dousseau', 'Pelisse', 'Baskov', 'Plenet', 'Dudkin', 'Dudkin', 'Dudkin', 'Baskov'],
        '2024-12-07' => ['Klyuev'],
        '2024-12-14' => ['Pitkänen', 'Dudkin', 'Dudkin', 'Dudkin'],
        '2024-12-21' => ['Klyuev', 'Richard', 'Bortino', 'Dudkin'],
        '2025-01-11' => ['Maarni', 'Dudkin', 'Maarni', 'Pelisse', 'Lazzaroni', 'Maarni', 'Maarni', 'Pelisse', 'Baskov'],
        '2025-01-18' => ['Baskov', 'Dudkin', 'Baskov', 'Dudkin'],
        '2025-01-25' => ['Maarni', 'Dousseau', 'Maarni', 'Baskov', 'Baskov', 'Dudkin', 'Pitkänen'],
        '2025-02-08' => ['Maarni', 'Lazzaroni', 'Maarni', 'Bortino', 'Zinger'],
        '2025-02-12' => ['Dudkin', 'Dudkin', 'Dudkin', 'Pitkänen', 'Briancon', 'Bortino', 'Dudkin', 'Maarni'],
        '2025-02-22' => ['Dudkin', 'Dudkin', 'Dudkin', 'Pitkänen', 'Briancon', 'Bortino', 'Dudkin', 'Maarni'],
        '2025-03-01' => ['Maarni', 'Baskov', 'Dudkin', 'Dudkin', 'Dudkin', 'Bortino'],
        '2025-03-08' => ['Clement', 'Dudkin', 'Baskov', 'Richard', 'Bortino', 'Plenet', 'Dudkin'],
    ];

    const ASSISTANCE_RENCONTRE_VALENCE = [
        '2024-10-05' => [
            'Maarni' => ['Lebouché'], 
            'Lazzaroni' => ['Richard', 'Dudkin'],
            'Dousseau' => ['Lazzaroni', 'Dudkin'],
            'Richard' => ['Maarni', 'Goutefangea'],
            'Plenet' => ['Dudkin'], 
            'Pitkänen' => ['Maarni'], 
        ],
        '2024-10-12' => [],
        '2024-10-19' => [
            'Maarni' => ['Dudkin', 'Lazzaroni'],
            'Pitkänen' => [],
        ],
        '2024-10-26' => [
            'Pelisse' => ['Clement', 'Lazzaroni'],
            'Lavorel' => ['Baskov'],
            'Plenet' => ['Baskov', 'Dousseau'],
        ],
        '2024-11-02' => [
            'Dudkin' => ['Maarni', 'Lazzaroni'],
            'Klyuev' => ['Baskov', 'Dudkin'],
            'Dudkin' => ['Baskov', 'Plenet'],
        ],
        '2024-11-09' => [
            'Baskov' => ['Plenet', 'Riffard'],
            'Richard' => ['Lazzaroni', 'Dudkin'],
            'Plenet' => ['Baskov', 'Plenet'],
            'Pitkänen' => ['Maarni', 'Klyuev'],
            'Dudkin' => ['Clement', 'Klyuev'],
            'Baskov' => ['Lazzaroni', 'Richard'],
        ],
        '2024-11-16' => [
            'Lazzaroni' => ['Pelisse', 'Favarin'],
            'Dudkin' => ['Baskov', 'Klyuev'],
            'Pelisse' => ['Baskov'],
        ],
        '2024-11-23' => [
            'Dudkin' => ['Baskov', 'Klyuev'],
            'Maarni' => ['Rodriguez.A', 'Zinger'],
            'Dudkin' => ['Baskov', 'Plenet'],
            'Pitkänen' => ['Maarni', 'Klyuev'],
            'Klyuev' => ['Baskov', 'Pelisse'],
        ],
        '2024-11-30' => [
            'Dousseau' => ['Dudkin'],
            'Pelisse' => ['Maarni', 'Zinger'],
            'Baskov' => ['Rifard', 'Lazzaroni'],
            'Dudkin' => ['Baskov'],
            'Dudkin' => [],
            'Dudkin' => ['Lazzaroni', 'Klyuev'],
            'Baskov' => [],
        ],
        '2024-12-07' => [
            'Klyuev' => ['Briancon', 'Dousseau'],
        ],
        '2024-12-14' => [
            'Pitkänen' => ['Maarni', 'Dudkin'],
            'Dudkin' => ['Maarni', 'Pitkänen'],
            'Dudkin' => ['Pitkänen'],
            'Dudkin' => ['Klyuev'],
        ],
        '2024-12-21' => [
            'Klyuev' => ['Lahssini', 'Bortino'],
            'Richard' => ['Baskov', 'Lazzaroni'],
            'Bortino' => ['Pitkänen'],
            'Dudkin' => ['Baskov', 'Lazzaroni'],
        ],
        '2025-01-11' => [
            'Maarni' => ['Zinger'],
            'Dudkin' => ['Baskov', 'Plenet'],
            'Maarni' => ['Pitkänen', 'Lazzaroni'],
            'Pelisse' => ['Pitkänen', 'Maarni'],
            'Lazzaroni' => ['Maarni', 'Bortino'],
            'Maarni' => ['Pitkänen', 'Zinger'],
            'Maarni' => ['Dousseau', 'Bortino'],
            'Pelisse' => ['Dudkin', 'Klyuev'],
            'Baskov' => ['Dudkin', 'Maarni'],
        ],
        '2025-01-18' => [
            'Baskov' => ['Dudkin', 'Plenet'],
            'Dudkin' => ['Baskov', 'Lazzaroni'],
            'Baskov' => ['Dudkin'],
            'Dudkin' => ['Baskov', 'Plenet'],
        ],
        '2025-01-25' => [
            'Maarni' => ['Pitkänen'],
            'Dousseau' => ['Zinger', 'Pitkänen'],
            'Maarni' => ['Baskov'],
            'Baskov' => ['Lazzaroni', 'Klyuev'],
            'Baskov' => ['Lazzaroni', 'Dudkin'],
            'Dudkin' => [],
            'Pitkänen' => ['Zinger', 'Bortino'],
        ],
        '2025-02-08' => [
            'Maarni' => ['Pitkänen', 'Bortino'],
            'Lazzaroni' => ['Plenet', 'Baskov'],
            'Maarni' => ['Zinger'],
            'Bortino' => ['Maarni'],
            'Zinger' => [],
        ],
        '2025-02-12' => [
            'Dudkin' => ['Lazzaroni', 'Plenet'],
            'Dudkin' => ['Lazzaroni', 'Baskov'],
            'Dudkin' => ['Zinger', 'Baskov'],
            'Pitkänen' => ['Maarni', 'Zinger'],
            'Briancon' => ['Dudkin', 'Plenet'],
            'Bortino' => ['Maarni', 'Pitkänen'],
            'Dudkin' => ['Plenet', 'Baskov'],
            'Maarni' => ['Bortino', 'Riffard'],
        ],
        '2025-02-22' => [
            'Dudkin' => ['Baskov', 'Klyuev'],
            'Bortino' => ['Maarni'],
            'Maarni' => ['Zinger', 'Dousseau'],
        ],
        '2025-03-01' => [
            'Maarni' => ['Pitkänen', 'Zinger'],
            'Baskov' => ['Lazzaroni', 'Dudkin'],
            'Dudkin' => ['Lazzaroni', 'Baskov'],
            'Dudkin' => ['Baskov', 'Klyuev'],
            'Dudkin' => ['Lazzaroni', 'Baskov'],
            'Bortino' => ['Lazzaroni'],
        ],
        '2025-03-08' => [
            'Clement' => ['Riffard'],
            'Dudkin' => ['Baskov'],
            'Baskov' => ['Lazzaroni', 'Dudkin'],
            'Richard' => ['Dudkin', 'Klyuev'],
            'Bortino' => ['Pitkänen'],
            'Plenet' => ['Pelisse', 'Clement'],
            'Dudkin' => ['Tkachenko'],
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
