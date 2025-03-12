<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\RencontreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RencontreController extends AbstractController
{
    #[Route('/matchs', name: 'rencontre_liste')]
    public function rencontreListe(RencontreRepository $rencontre): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }

        $equipe = $user->getEquipe();

        $rencontres = $rencontre->createQueryBuilder('rencontre')
            ->where('rencontre.equipe_domicile = :equipe OR rencontre.equipe_exterieur = :equipe')
            ->setParameter('equipe', $equipe)
            ->getQuery()
            ->getResult();

        return $this->render('rencontre/rencontre_liste.html.twig', [
            'rencontres' => $rencontres,
            'controller_name' => 'LoisirsProspects - Matchs',
        ]);
    }
}
