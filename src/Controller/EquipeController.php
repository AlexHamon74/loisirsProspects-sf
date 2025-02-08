<?php

namespace App\Controller;

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
}
