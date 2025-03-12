<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\User;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EquipeController extends AbstractController
{
    #[Route('/equipes', name: 'equipe_liste')]
    public function equipeListe(EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findAll();

        return $this->render('equipe/equipe_liste.html.twig', [
            'controller_name' => 'LoisirsProspects - Equipes',
            'equipes' => $equipes,
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe_details')]
    public function equipeDetails(Equipe $equipe): Response
    {
        $users = $equipe->getUsers();

        return $this->render('equipe/equipe_details.html.twig', [
            'controller_name' => 'LoisirsProspects - Equipes',
            'equipe' => $equipe,
            'users' => $users,
        ]);
    }

    #[Route('/mon_equipe', name: 'mon_equipe')]
    public function monEquipe(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }

        $equipe = $user->getEquipe();
        $users = $equipe->getUsers();

        return $this->render('equipe/mon_equipe.html.twig', [
            'equipe' => $equipe,
            'users' => $users,
            'controller_name' => 'LoisirsProspects - Mon Equipe',
        ]);
    }
}
