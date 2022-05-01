<?php

namespace App\Controller\Backoffice;

use App\Entity\FactureKM;
use App\Form\FactureKMType;
use App\Repository\FactureKMRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/facture-km')]
class FactureKMController extends AbstractController
{
    #[Route('/', name: 'facture_k_m_index', methods: ['GET'])]
    public function index(FactureKMRepository $factureKMRepository): Response
    {
        return $this->render('facture_km/index.html.twig', [
            'facture_k_ms' => $factureKMRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'facture_k_m_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $factureKM = new FactureKM();
        $form = $this->createForm(FactureKMType::class, $factureKM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($factureKM);
            $entityManager->flush();

            return $this->redirectToRoute('facture_k_m_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_km/new.html.twig', [
            'facture_k_m' => $factureKM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_k_m_show', methods: ['GET'])]
    public function show(FactureKM $factureKM): Response
    {
        return $this->render('facture_km/show.html.twig', [
            'facture_k_m' => $factureKM,
        ]);
    }

    #[Route('/{id}/edit', name: 'facture_k_m_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FactureKM $factureKM, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureKMType::class, $factureKM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('facture_k_m_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_km/edit.html.twig', [
            'facture_k_m' => $factureKM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_k_m_delete', methods: ['POST'])]
    public function delete(Request $request, FactureKM $factureKM, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factureKM->getId(), $request->request->get('_token'))) {
            $entityManager->remove($factureKM);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_k_m_index', [], Response::HTTP_SEE_OTHER);
    }
}
