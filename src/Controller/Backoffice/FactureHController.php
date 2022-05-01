<?php

namespace App\Controller\Backoffice;
use App\Entity\FactureH;
use App\Form\FactureHType;
use App\Repository\FactureHRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/facture-h')]
class FactureHController extends AbstractController
{
    #[Route('/', name: 'facture_h_index', methods: ['GET'])]
    public function index(FactureHRepository $factureHRepository): Response
    {
        return $this->render('facture_h/index.html.twig', [
            'facture_hs' => $factureHRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'facture_h_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $factureH = new FactureH();
        $form = $this->createForm(FactureHType::class, $factureH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($factureH);
            $entityManager->flush();

            return $this->redirectToRoute('facture_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_h/new.html.twig', [
            'facture_h' => $factureH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_h_show', methods: ['GET'])]
    public function show(FactureH $factureH): Response
    {
        return $this->render('facture_h/show.html.twig', [
            'facture_h' => $factureH,
        ]);
    }

    #[Route('/{id}/edit', name: 'facture_h_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FactureH $factureH, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureHType::class, $factureH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('facture_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_h/edit.html.twig', [
            'facture_h' => $factureH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'facture_h_delete', methods: ['POST'])]
    public function delete(Request $request, FactureH $factureH, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factureH->getId(), $request->request->get('_token'))) {
            $entityManager->remove($factureH);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_h_index', [], Response::HTTP_SEE_OTHER);
    }
}
