<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);

            // Create profile
            $roles = $user->getRoles();
            $nom = $form->get('nom')->getData();
            $prenom = $form->get('prenom')->getData();
            $identifier = $form->get('identifier')->getData();

            if (in_array('ROLE_ADHERENT', $roles)) {
                $adherent = new \App\Entity\Adherent();
                $adherent->setNom($nom);
                $adherent->setPrenom($prenom);
                $adherent->setCin($identifier);
                $adherent->setUser($user);
                $entityManager->persist($adherent);
            } elseif (in_array('ROLE_BIBLIOTHECAIRE', $roles)) {
                $biblio = new \App\Entity\Bibliothecaire();
                $biblio->setNom($nom);
                $biblio->setPrenom($prenom);
                $biblio->setMatricule((int)$identifier);
                $biblio->setUser($user);
                $entityManager->persist($biblio);
            }

            $entityManager->flush();

            return $security->login($user, UserAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
