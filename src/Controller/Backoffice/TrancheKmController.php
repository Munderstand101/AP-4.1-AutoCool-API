<?php

namespace App\Controller\Backoffice;

use App\Entity\TrancheKm;
use App\Form\TrancheKmType;
use App\Repository\TrancheKmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/tranche-km')]
class TrancheKmController extends AbstractController
{
    #[Route('/', name: 'tranche_km_index', methods: ['GET'])]
    public function index(TrancheKmRepository $trancheKmRepository): Response
    {
        return $this->render('tranche_km/index.html.twig', [
            'tranche_kms' => $trancheKmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tranche_km_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trancheKm = new TrancheKm();
        $form = $this->createForm(TrancheKmType::class, $trancheKm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trancheKm);
            $entityManager->flush();

            return $this->redirectToRoute('tranche_km_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tranche_km/new.html.twig', [
            'tranche_km' => $trancheKm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tranche_km_show', methods: ['GET'])]
    public function show(TrancheKm $trancheKm): Response
    {
        return $this->render('tranche_km/show.html.twig', [
            'tranche_km' => $trancheKm,
        ]);
    }

    #[Route('/{id}/edit', name: 'tranche_km_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrancheKm $trancheKm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrancheKmType::class, $trancheKm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tranche_km_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tranche_km/edit.html.twig', [
            'tranche_km' => $trancheKm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tranche_km_delete', methods: ['POST'])]
    public function delete(Request $request, TrancheKm $trancheKm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trancheKm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trancheKm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tranche_km_index', [], Response::HTTP_SEE_OTHER);
    }
}
