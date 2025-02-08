<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JoueurController extends AbstractController
{
    #[Route('/mon_equipe', name: 'mon_equipe')]
    public function index(): Response
    {
        return $this->render('joueur/mon_equipe.html.twig', [
            'controller_name' => 'Mon Equipe',
        ]);
    }
}
