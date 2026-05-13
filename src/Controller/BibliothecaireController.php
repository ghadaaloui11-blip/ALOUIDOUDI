<?php

namespace App\Controller;

use App\Entity\Bibliothecaire;
use App\Form\Bibliothecaire1Type;
use App\Repository\BibliothecaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bibliothecaire')]
final class BibliothecaireController extends AbstractController
{
    #[Route(name: 'app_bibliothecaire_index', methods: ['GET'])]
    public function index(BibliothecaireRepository $bibliothecaireRepository): Response
    {
        return $this->render('bibliothecaire/index.html.twig', [
            'bibliothecaires' => $bibliothecaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bibliothecaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bibliothecaire = new Bibliothecaire();
        $form = $this->createForm(Bibliothecaire1Type::class, $bibliothecaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bibliothecaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_bibliothecaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bibliothecaire/new.html.twig', [
            'bibliothecaire' => $bibliothecaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bibliothecaire_show', methods: ['GET'])]
    public function show(Bibliothecaire $bibliothecaire): Response
    {
        return $this->render('bibliothecaire/show.html.twig', [
            'bibliothecaire' => $bibliothecaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bibliothecaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bibliothecaire $bibliothecaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Bibliothecaire1Type::class, $bibliothecaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bibliothecaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bibliothecaire/edit.html.twig', [
            'bibliothecaire' => $bibliothecaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bibliothecaire_delete', methods: ['POST'])]
    public function delete(Request $request, Bibliothecaire $bibliothecaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bibliothecaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bibliothecaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bibliothecaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
