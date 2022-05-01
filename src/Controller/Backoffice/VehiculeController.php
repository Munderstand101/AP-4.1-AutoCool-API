<?php

namespace App\Controller\Backoffice;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/vehicule')]
class VehiculeController extends AbstractController
{
    #[Route('/', name: 'vehicule_index', methods: ['GET'])]
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehiculeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'vehicule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicule);
            $entityManager->flush();

            return $this->redirectToRoute('vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicule/new.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'vehicule_show', methods: ['GET'])]
    public function show(Vehicule $vehicule): Response
    {
        return $this->render('vehicule/show.html.twig', [
            'vehicule' => $vehicule,
        ]);
    }

    #[Route('/{id}/edit', name: 'vehicule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicule/edit.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'vehicule_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicule $vehicule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicule_index', [], Response::HTTP_SEE_OTHER);
    }
}
