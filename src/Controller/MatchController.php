<?php

namespace App\Controller;

use App\Repository\RencontreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'matchs')]
    public function matchs(RencontreRepository $rencontre): Response
    {
        $matchs = $rencontre->findAll();

        return $this->render('match/match.html.twig', [
            'matchs' => $matchs,
            'controller_name' => 'LoisirsProspects - Matchs',
        ]);
    }
}
