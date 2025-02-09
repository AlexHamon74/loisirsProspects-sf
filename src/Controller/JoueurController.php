<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JoueurController extends AbstractController
{
    #[Route('/mon_equipe', name: 'mon_equipe')]
    public function mon_equipe(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        
        if (!$user instanceof User) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }

        $equipe = $user->getEquipe();
        $users = $userRepository->findBy(['equipe' => $equipe]);

        return $this->render('joueur/mon_equipe.html.twig', [
            'users' => $users,
            'controller_name' => 'Mon Equipe',
        ]);
    }
}
