<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EquipeController extends AbstractController
{
    #[Route('/equipes', name: 'equipes')]
    public function equipes(EquipeRepository $repository): Response
    {
        $equipes = $repository->findAll();

        return $this->render('equipe/equipes.html.twig', [
            'controller_name' => 'LoisirsProspects - Equipes',
            'equipes' => $equipes,
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe')]
    public function equipe(Equipe $equipe): Response
    {
        $users = $equipe->getUsers();

        return $this->render('equipe/equipe.html.twig', [
            'controller_name' => 'LoisirsProspects - Equipes',
            'equipe' => $equipe,
            'users' => $users,
        ]);
    }
}
