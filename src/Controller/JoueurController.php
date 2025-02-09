<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\MonProfilType;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'controller_name' => 'LoisirsProspects - Mon Equipe',
        ]);
    }

    #[Route('/mon_profil/{id}', name: 'mon_profil')]
    public function mon_profil(User $user, EntityManagerInterface $em, Request $request): Response
    {

        $form = $this->createForm(MonProfilType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new DateTimeImmutable());
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre profil à bien été édité');
            return $this->redirectToRoute('index');
        }

        return $this->render('joueur/mon_profil.html.twig', [
            'controller_name' => 'LoisirsProspects - Mon Profil',
            'user' => $user,
            'form' => $form
        ]);
    }
}
