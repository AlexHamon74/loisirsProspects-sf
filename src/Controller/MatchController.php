<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'matchs')]
    public function matchs(): Response
    {
        return $this->render('match/match.html.twig', [
            'controller_name' => 'LoisirsProspects - Matchs',
        ]);
    }
}
