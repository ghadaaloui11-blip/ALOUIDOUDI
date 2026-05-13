<?php

namespace App\Controller;

use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/bibliothecaire', name: 'dashboard_bibliothecaire')]
    #[IsGranted('ROLE_BIBLIOTHECAIRE')]
    public function bibliothecaire(EmpruntRepository $empruntRepository): Response
    {
        $user = $this->getUser();
        $bibliothecaire = $user->getBibliothecaire();

        if (!$bibliothecaire) {
            return $this->render('dashboard/missing_profile.html.twig', ['role' => 'Bibliothécaire']);
        }

        $emprunts = $empruntRepository->findBy(['bibliothecaire' => $bibliothecaire]);

        return $this->render('dashboard/bibliothecaire.html.twig', [
            'bibliothecaire' => $bibliothecaire,
            'emprunts' => $emprunts,
        ]);
    }

    #[Route('/adherent', name: 'dashboard_adherent')]
    #[IsGranted('ROLE_ADHERENT')]
    public function adherent(EmpruntRepository $empruntRepository): Response
    {
        $user = $this->getUser();
        $adherent = $user->getAdherent();

        if (!$adherent) {
            return $this->render('dashboard/missing_profile.html.twig', ['role' => 'Adhérent']);
        }

        $emprunts = $empruntRepository->findBy(['adherent' => $adherent]);

        return $this->render('dashboard/adherent.html.twig', [
            'adherent' => $adherent,
            'emprunts' => $emprunts,
        ]);
    }
}
