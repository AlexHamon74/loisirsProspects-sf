<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\RencontreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'matchs')]
    public function matchs(RencontreRepository $rencontre): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }

        $equipe = $user->getEquipe();

        $matchs = $rencontre->createQueryBuilder('rencontre')
            ->where('rencontre.equipe_domicile = :equipe OR rencontre.equipe_exterieur = :equipe')
            ->setParameter('equipe', $equipe)
            ->getQuery()
            ->getResult();

        return $this->render('match/match.html.twig', [
            'matchs' => $matchs,
            'controller_name' => 'LoisirsProspects - Matchs',
        ]);
    }
}
