<?php

namespace App\Controller\Backoffice;

use App\Entity\TrancheHoraire;
use App\Form\TrancheHoraireType;
use App\Repository\TrancheHoraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/tranche-horaire')]
class TrancheHoraireController extends AbstractController
{
    #[Route('/', name: 'tranche_horaire_index', methods: ['GET'])]
    public function index(TrancheHoraireRepository $trancheHoraireRepository): Response
    {
        return $this->render('tranche_horaire/index.html.twig', [
            'tranche_horaires' => $trancheHoraireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tranche_horaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trancheHoraire = new TrancheHoraire();
        $form = $this->createForm(TrancheHoraireType::class, $trancheHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trancheHoraire);
            $entityManager->flush();

            return $this->redirectToRoute('tranche_horaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tranche_horaire/new.html.twig', [
            'tranche_horaire' => $trancheHoraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tranche_horaire_show', methods: ['GET'])]
    public function show(TrancheHoraire $trancheHoraire): Response
    {
        return $this->render('tranche_horaire/show.html.twig', [
            'tranche_horaire' => $trancheHoraire,
        ]);
    }

    #[Route('/{id}/edit', name: 'tranche_horaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrancheHoraire $trancheHoraire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrancheHoraireType::class, $trancheHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tranche_horaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tranche_horaire/edit.html.twig', [
            'tranche_horaire' => $trancheHoraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tranche_horaire_delete', methods: ['POST'])]
    public function delete(Request $request, TrancheHoraire $trancheHoraire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trancheHoraire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trancheHoraire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tranche_horaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
