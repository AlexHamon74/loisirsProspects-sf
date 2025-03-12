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

class UserController extends AbstractController
{
    #[Route('/mon_profil/{id}', name: 'mon_profil')]
    public function monProfil(User $user, EntityManagerInterface $em, Request $request): Response
    {

        $form = $this->createForm(MonProfilType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new DateTimeImmutable());
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre profil à bien été édité');
            return $this->redirectToRoute('accueil');
        }

        return $this->render('user/mon_profil.html.twig', [
            'controller_name' => 'LoisirsProspects - Mon Profil',
            'user' => $user,
            'form' => $form
        ]);
    }
}
